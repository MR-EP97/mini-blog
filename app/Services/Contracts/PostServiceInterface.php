<?php


namespace App\Services\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Post;
use App\DTOs\PostDTO;
use Illuminate\Pagination\LengthAwarePaginator;

interface PostServiceInterface
{

    public function all(): Collection;

    public function find(int $id): ?Post;

    public function findBySlug(string $slug): ?Post;

    public function createPost(PostDTO $postDTO): Post;

    public function updatePost(int $id, PostDTO $postDTO): ?Post;

    public function delete(int $id): bool;

    public function search(string $query, int $perPage = 15, int $page = 1): LengthAwarePaginator;
}
