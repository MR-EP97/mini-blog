<?php

namespace App\Livewire\Blog;

use Livewire\Component;
use App\Services\PostService;
use App\DTOs\PostDTO;
use App\Enums\Post\PostStatus;
use App\Models\Category;
use Illuminate\Support\Str;

class PostCreate extends Component
{
    protected PostService $postService;

    // Form fields
    public $title = '';
    public $content = '';
    public $category_id = '';
    public $status = 'draft';
    public $published_at = '';

    // Categories
    public $categories = [];

    // State
    public $isSubmitting = false;
    public $successMessage = '';
    public $errorMessage = '';
    public $validationErrors = [];

    // Validation rules
    protected $rules = [
        'title' => 'required|min:3|max:255',
        'content' => 'required|min:10',
        'category_id' => 'required|integer',
        'status' => 'required|in:draft,published,archived',
        'published_at' => 'nullable|date',
    ];

    // Custom validation messages
    protected $messages = [
        'title.required' => 'عنوان پست الزامی است',
        'title.min' => 'عنوان باید حداقل 3 کاراکتر باشد',
        'title.max' => 'عنوان نباید بیشتر از 255 کاراکتر باشد',
        'content.required' => 'محتوای پست الزامی است',
        'content.min' => 'محتوا باید حداقل 10 کاراکتر باشد',
        'category_id.required' => 'انتخاب دسته‌بندی الزامی است',
        'category_id.integer' => 'دسته‌بندی نامعتبر است',
        'status.required' => 'وضعیت پست الزامی است',
        'status.in' => 'وضعیت انتخابی نامعتبر است',
        'published_at.date' => 'تاریخ انتشار نامعتبر است',
    ];

    /**
     * Boot method to inject service
     */
    public function boot(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Real-time validation
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        if (isset($this->validationErrors[$propertyName])) {
            unset($this->validationErrors[$propertyName]);
        }
    }

    public function mount()
    {
        $this->loadCategories();
    }

    protected function loadCategories(): void
    {
        // Get all categories ordered by nested set structure
        $allCategories = Category::defaultOrder()->get();

        // Build tree structure with depth indication
        $this->categories = $allCategories->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
                'depth' => $category->depth,
                'parent_id' => $category->parent_id,
            ];
        })->toArray();
    }

    /**
     * Submit form
     */
    public function submit()
    {
        // Validate
        $this->validate();

        $this->isSubmitting = true;
        $this->successMessage = '';
        $this->errorMessage = '';
        $this->validationErrors = [];

        try {
            // Generate slug from title
            $slug = Str::slug($this->title) . '-' . Str::random(5);

            // Create DTO
            $postDTO = new PostDTO([
                'user_id' => auth()->id() ?? 1,
                'category_id' => $this->category_id,
                'title' => $this->title,
                'slug' => $slug,
                'content' => $this->content,
                'published_at' => $this->published_at ?: null,
                'status' => $this->status,
            ]);

            // Create post using service
            $post = $this->postService->createPost($postDTO);

            $this->successMessage = 'پست با موفقیت ایجاد شد!';

            // Reset form
            $this->reset(['title', 'content', 'category_id', 'status', 'published_at']);

            // Dispatch browser event for redirect
            $this->dispatch('post-created', [
                'slug' => $post->slug
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->validationErrors = $e->errors();
            $this->errorMessage = 'لطفاً خطاهای فرم را بررسی کنید';
        } catch (\Exception $e) {
            $this->errorMessage = 'خطا در ایجاد پست: ' . $e->getMessage();
        }

        $this->isSubmitting = false;
    }

    /**
     * Clear messages
     */
    public function clearMessages()
    {
        $this->successMessage = '';
        $this->errorMessage = '';
        $this->validationErrors = [];
    }

    /**
     * Render component
     */
    public function render()
    {
        return view('livewire.blog.post-create');
    }
}
