<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Enums\Post\PostStatus;
use App\Http\Requests\Post\PostStoreRequest;
use App\Services\Contracts\PostServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\DTOs\PostDTO;
use App\Http\Requests\Post\PostIndexRequest;
use App\Http\Requests\Post\PostUpdateRequest;
use Symfony\Component\HttpFoundation\Response as ResponseCode;

class PostController extends Controller
{

    public function __construct(protected PostServiceInterface $postService)
    {

    }

    public function index(PostIndexRequest $request): JsonResponse
    {
        return response()->json($this->postService->search(
            $request->validated()['search'] ?? null,
            $request->validated()['per_page'] ?? 15,
            $request->validated()['page'] ?? 1
        )->toArray());
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

        $post = $this->postService->updatePost($id, $dto);

        return response()->json($post);

    }

    public function destroy(Post $post): JsonResponse
    {
        $post->delete();
        return response()->json(null, ResponseCode::HTTP_NO_CONTENT);
    }
}
