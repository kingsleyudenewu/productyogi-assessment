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

    public function store(CreateCommentRequest $request)
    {
        $commentData = (new CreateCommentAction())->execute($request->validated());
    }

    public function show(int $id)
    {

    }

    public function update()
    {

    }
}
