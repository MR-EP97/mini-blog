<?php

namespace App\Livewire\Blog;

use App\Services\Contracts\PostServiceInterface as PostService;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use function Pest\Laravel\json;
use function PHPUnit\Framework\isEmpty;
use Livewire\Attributes\On;

class BlogIndex extends Component
{
    public $perPage = 15;
    public $posts = [];
    public $pagination = [];
    public $isLoading = true;
    public $page = 1;
    public $search = '';
    protected $listeners = ['searchUpdated' => 'handleSearchUpdate'];


    protected PostService $service;

    public function boot(PostService $service): void
    {
        $this->service = $service;
    }

    public function mount(): void
    {
        $this->loadPosts();
    }

    #[On('searchUpdated')]
    public function handleSearchUpdate($search): void
    {
        \Log::info($this->search . ' ---- ' . 'handleSearchUpdate');

        $this->search = $search;
        $this->page = 1;
        $this->loadPosts();

    }

    public function loadPosts(): void
    {

        $this->isLoading = true;

        $paginator = $this->service->search(
            $this->search ?? '',
            $this->perPage ?? 10,
            $this->page
        );

        $this->posts = $paginator->items();


        $links = collect($paginator->toArray()['links'])->map(function ($link) {
            $page = null;
            if ($link['url']) {
                parse_str(parse_url($link['url'], PHP_URL_QUERY), $query);
                $page = $query['page'] ?? null;
            }
            return [
                'label' => $link['label'],
                'url' => $link['url'],
                'active' => $link['active'],
                'page' => $page,
            ];
        })->toArray();

        $this->pagination = [
            'current_page' => $paginator->currentPage(),
            'last_page' => $paginator->lastPage(),
            'per_page' => $paginator->perPage(),
            'total' => $paginator->total(),
            'from' => $paginator->firstItem(),
            'to' => $paginator->lastItem(),
            'links' => $links,
        ];

        $this->isLoading = false;
    }

    public function gotoPage($page): void
    {
        if ($page < 1 || $page > $this->pagination['last_page']) {
            return;
        }

        $this->page = $page;
        $this->loadPosts();
    }


    public function clearSearch(): void
    {
        \Log::info($this->search . ' ---- ' . 'clearSearch');

        $this->search = '';
        $this->page = 1;
        $this->loadPosts();
    }

    public function updatedSearch(): void
    {
        $this->page = 1;
        $this->loadPosts();
    }

    public function render()
    {
        return view('livewire.blog.blog-index');
    }
}
