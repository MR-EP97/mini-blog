<?php

namespace App\DTOs;

use App\Enums\Post\PostStatus;

class PostDTO
{
    public ?int $id;
    public int $user_id;
    public ?int $category_id;
    public string $title;
    public string $slug;
    public string $content;
    public ?string $published_at;
    public PostStatus $status;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->user_id = $data['user_id'];
        $this->category_id = $data['category_id'] ?? null;
        $this->title = $data['title'];
        $this->slug = $data['slug'];
        $this->content = $data['content'];
        $this->published_at = $data['published_at'] ?? null;
        $this->status = PostStatus::from($data['status']);
    }

    
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'published_at' => $this->published_at,
            'status' => $this->status->value,
        ];
    }
}
