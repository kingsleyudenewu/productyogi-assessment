<?php

namespace App\Actions;

use App\Models\Post;

class CreatePostAction
{
    public function execute(array $data)
    {
        return Post::create($data);
    }
}
