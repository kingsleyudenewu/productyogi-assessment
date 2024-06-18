<?php

namespace App\Actions;

use App\Models\Post;

class CreatePostAction
{
    /**
     * @param array $data
     * @return mixed
     */
    public function execute(array $data)
    {
        return Post::create($data);
    }

    /**
     * @param Post $post
     * @param array $data
     * @return bool
     */
    public function updatePost(Post $post, array $data)
    {
        return $post->update($data);
    }
}
