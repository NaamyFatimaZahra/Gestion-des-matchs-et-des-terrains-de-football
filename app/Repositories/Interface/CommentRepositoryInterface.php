<?php

namespace App\Repositories\Interface;

use App\Models\Comment;

Interface CommentRepositoryInterface
{
    public function getAllComments( );
    public function deleteComment(Comment $comment): bool;
        public function isDeleted(Comment $comment): bool;

}
