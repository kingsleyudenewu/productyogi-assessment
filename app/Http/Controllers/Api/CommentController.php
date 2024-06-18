<?php

namespace App\Http\Controllers\Api;

use App\Actions\CreateCommentAction;
use App\Actions\CreatePostAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCommentRequest;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCommentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateCommentRequest $request): \Illuminate\Http\JsonResponse
    {
        $commentData = (new CreateCommentAction())->execute($request->validated());

        return $this->createdResponse('Comment created successfully', $commentData);
    }

    public function show(int $id)
    {

    }

    public function update()
    {

    }
}
