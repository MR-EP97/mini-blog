<?php

namespace App\Services;

use App\Repositories\Contracts\PostRepositoryInterface;
use App\Models\Post;
use App\DTOs\PostDTO;
use Illuminate\Database\Eloquent\Collection;
use App\Services\Contracts\PostServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class PostService implements PostServiceInterface
{
    public function __construct(protected PostRepositoryInterface $postRepository)
    {
    }

    public function all(): Collection
    {
        return $this->postRepository->all();
    }

    public function find(int $id): ?Post
    {
        return $this->postRepository->find($id);
    }

    public function findBySlug(string $slug): ?Post
    {
        return $this->postRepository->findBySlug($slug);
    }

    public function createPost(PostDTO $postDTO): Post
    {
        return $this->postRepository->create($postDTO);
    }

    public function updatePost(int $id, PostDTO $postDTO): ?Post
    {
        return $this->postRepository->update($id, $postDTO);
    }

    public function delete(int $id): bool
    {
        return $this->postRepository->delete($id);
    }

    public function search(string $query = null, int $perPage = 15, int $page = 1): LengthAwarePaginator
    {
        return $this->postRepository->search($query, $perPage, $page);
    }
}
