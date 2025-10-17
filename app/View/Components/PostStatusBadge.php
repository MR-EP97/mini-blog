<?php

namespace App\View\Components;

use App\Enums\Post\PostStatus;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PostStatusBadge extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $status,
        public string $position = 'absolute top-4 right-4'
    )
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.post-status-badge');
    }

    /**
     * Get configuration for status badge
     */
    public function config(): array
    {
        return match ($this->status) {
            PostStatus::Published->value => [
                'text' => 'منتشر شده',
                'class' => 'bg-green-500',
                'icon' => '✓'
            ],
            PostStatus::Archived->value => [
                'text' => 'آرشیو شده',
                'class' => 'bg-gray-500',
                'icon' => ''
            ],
            default => [
                'text' => 'پیش‌نویس',
                'class' => 'bg-yellow-500',
                'icon' => '✎'
            ]
        };
    }
}
