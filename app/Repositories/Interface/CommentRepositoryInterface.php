<?php

namespace App\Repositories\Interface;

use App\Models\Comment;

Interface CommentRepositoryInterface
{
    public function getAll();
    public function findById($id);
    public function createComment(array $data);
    public function getCommentsByProprietaire($perPage = 10);
    public function deleteComment(Comment $comment): bool;
    public function isDeleted(Comment $comment): bool;

}
