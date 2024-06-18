<?php

namespace App\Http\Controllers\Api;

use App\Actions\CreatePostAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $postCollection = Post::with('user')->searchPost($request)->paginate();

        $resourceData = PostResource::collection($postCollection)->response();

        return $this->successResponse('Posts fetched successfully.', $resourceData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreatePostRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreatePostRequest $request): \Illuminate\Http\JsonResponse
    {
        $postData = (new CreatePostAction())->execute($request->validated());

        return $this->createdResponse('Post created successfully', $postData);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id): \Illuminate\Http\JsonResponse
    {
        $post = Post::with('user')->findOrFail($id);

        $resourceData = new PostResource($post);

        return $this->successResponse('Post fetched successfully.', $resourceData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Post $post
     * @param CreatePostRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Post $post, CreatePostRequest $request): \Illuminate\Http\JsonResponse
    {
        $postData = (new CreatePostAction())->updatePost($post, $request->validated());

        return $this->successResponse('Post updated successfully', $postData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Post $post): \Illuminate\Http\JsonResponse
    {
        $post->delete();

        return $this->successResponse('Post deleted successfully.');
    }
}
