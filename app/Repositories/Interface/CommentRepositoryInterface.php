<?php

namespace App\Repositories\Interface;

use App\Models\Comment;

Interface CommentRepositoryInterface
{
    public function getAll();
    public function findById($id);
    public function createComment(array $data);
    public function getCommentsByProprietaire();
    public function deleteComment(Comment $comment): bool;
    public function isDeleted(Comment $comment): bool;

}
