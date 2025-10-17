<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Enums\Post\PostStatus;
use App\Http\Requests\Post\PostStoreRequest;
use App\Services\Contracts\PostServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\DTOs\PostDTO;
use App\Http\Requests\Post\PostIndexRequest;
use App\Http\Requests\Post\PostUpdateRequest;

class PostController extends Controller
{

    public function __construct(protected PostServiceInterface $postService)
    {

    }

    public function index(PostIndexRequest $request)
    {
        return $this->postService->search(
            $request->validated()['search'] ?? null,
            $request->validated()['per_page'] ?? 15
        );
    }

    public function store(PostStoreRequest $request)
    {

        $validated = $request->validated();


        $dto = new PostDTO([
            'user_id' => $validated['user_id'],
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'content' => $validated['content'],
            'published_at' => $validated['published_at'],
            'status' => $validated['status'],
        ]);


        $post = $this->postService->createPost($dto);

        return response()->json($post, 201);
    }

    public function show(string $slug)
    {
        return $this->postService->findBySlug($slug);
    }

    public function update(PostUpdateRequest $request, int $id)
    {
        // $validated = $request->validate([
        //     'user_id' => ['sometimes', 'exists:users,id'],
        //     'category_id' => ['sometimes', 'exists:categories,id'],
        //     'title' => ['sometimes', 'string', 'max:255'],
        //     'slug' => ['sometimes', 'string', 'max:255', Rule::unique('posts', 'slug')->ignore($post->id)],
        //     'content' => ['nullable', 'string'],
        //     'published_at' => ['nullable', 'date'],
        //     'status' => ['sometimes', Rule::in(array_column(PostStatus::cases(), 'value'))],
        // ]);

        $dto =

            $this->postService->updatePost();

        return response()->json($post);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json(null, 204);
    }
}
