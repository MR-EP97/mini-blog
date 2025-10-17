<?php

namespace App\Models;

use App\Enums\Post\PostStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'content',
        'published_at',
        'status',
    ];

    protected array $cast = [
        'title' => 'string',
        'slug' => 'string',
        'published_at' => 'datetime',
        'status' => PostStatus::class,

    ];


    // Scopes

    // public function scopePublished($query)
    // {
    //     return $query->where('status', 'published')
    //                  ->whereNotNull('published_at')
    //                  ->where('published_at', '<=', now());
    // }


    // Relations

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


}
