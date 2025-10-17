<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\PostRepositoryInterface;
use App\Models\Post;
use App\DTOs\PostDTO;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PostRepository implements PostRepositoryInterface
{
    public function __construct(protected Post $postModel)
    {
    }

    public function all(): Collection
    {
        return $this->postModel->all();
    }

    public function find(int $id): ?Post
    {
        return $this->postModel->find($id);
    }

    public function findBySlug(string $slug): ?Post
    {
        return $this->postModel->where('slug', $slug)->with(['user', 'category.ancestors'])->first();
    }

    public function create(PostDTO $postDTO): Post
    {
        $data = $postDTO->toArray();

        unset($data['id']);

        return $this->postModel->create($data);
    }

    public function update(int $id, PostDTO $postDTO): ?Post
    {
        $post = $this->postModel->find($id);
        if (!$post) {
            return null;
        }

        $data = $postDTO->toArray();

        unset($data['id']);

        $post->update($data);

        return $post;
    }

    public function delete(int $id): bool
    {
        $post = $this->postModel->find($id);
        if (!$post) {
            return false;
        }

        return (bool)$post->delete();
    }

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->postModel->paginate($perPage);
    }


    public function search(string $query = null, int $perPage = 15, int $page = 1): LengthAwarePaginator
    {
        return $this->postModel
            ->query()
            ->when($query, function ($q) use ($query) {
                $q->whereFullText(['title', 'content'], $query);
            })
            ->with(['user', 'category.ancestors'])
            ->latest()
            ->paginate($perPage, page: $page);
    }
}
