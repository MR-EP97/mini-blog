<?php

namespace App\Livewire\Blog;

use Livewire\Component;

class SearchBar extends Component
{
    public $search = '';
    public $placeholder = 'جستجو در مقالات...';
    public $showClearButton = true;
    protected $listeners = ['clearSearchInput' => 'clearSearch'];

    /**
     * Update search and emit event to parent
     */
    public function updatedSearch()
    {
        $this->emit('searchUpdated', $this->search);
    }

    /**
     * Clear search
     */
    public function clearSearch()
    {
        $this->search = '';
        $this->emit('searchUpdated', '');
    }

    /**
     * Render component
     */
    public function render()
    {
        return view('livewire.blog.search-bar');
    }
}
