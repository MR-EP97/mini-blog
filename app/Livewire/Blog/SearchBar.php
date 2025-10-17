<?php

namespace App\Livewire\Blog;

use Livewire\Component;
use Livewire\Attributes\On;

class SearchBar extends Component
{

    public $search = '';
    public $placeholder = 'جستجو در مقالات...';
    public $showClearButton = false;
    protected $listeners = ['clearSearchInput' => 'clearSearch'];

    /**
     * Update search and emit event to parent
     */
    public function updatedSearch()
    {
        $this->dispatch('searchUpdated', search: $this->search);
    }

    /**
     * Clear search
     */
    #[On('clearSearchInput')]
    public function clearSearch()
    {
        $this->search = '';
        $this->dispatch('searchUpdated', search: '');
    }

    /**
     * Render component
     */
    public function render()
    {
        return view('livewire.blog.search-bar');
    }
}
