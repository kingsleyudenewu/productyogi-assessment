<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(Post $post)
    {
        $post = $post->load('user', 'comments');

        return view('post.show', compact('post'));
    }
}
