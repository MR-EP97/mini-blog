<?php

namespace App\Livewire\Blog;

use App\Services\Contracts\PostServiceInterface as PostService;
use Livewire\Component;

class BlogShow extends Component
{
    public $slug;
    public $post = null;
    public $isLoading = true;
    public $error = null;

    protected PostService $service;

    public function boot(PostService $service): void
    {
        $this->service = $service;
    }

    /**
     * Mount component
     */
    public function mount($slug)
    {
        $this->slug = $slug;
        $this->loadPost();
    }

    /**
     * Load post from API
     */
    public function loadPost()
    {
        $this->isLoading = true;
        $this->error = null;

        $this->post = $this->service->findBySlug($this->slug);


        $this->isLoading = false;
    }

    /**
     * Render component
     */

    public function render()
    {
        return view('livewire.blog.blog-show');
    }
}
