<?php

namespace App\Repositories\Eloquent;

use App\Models\Comment;
use App\Repositories\Interface\CommentRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{
    public function getAllComments( )   
    {
        return Comment::with(['user', 'terrain'])->get();
    }
    public function deleteComment(Comment $comment): bool
    {
   if ($comment->delete()) {
          return true;
    }

    return false;
   
    }

    public function isDeleted(Comment $comment): bool
{
    return $comment->trashed();
}
}
