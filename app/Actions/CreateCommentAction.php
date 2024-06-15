<?php

namespace App\Actions;

use App\Models\Comment;

class CreateCommentAction
{
    public function execute(array $data)
    {
        return Comment::create($data);
    }
}
