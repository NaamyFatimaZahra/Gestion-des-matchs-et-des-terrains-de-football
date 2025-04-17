<?php

namespace App\Repositories\Eloquent;

use App\Models\Comment;
use App\Repositories\Interface\CommentRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class CommentRepository implements CommentRepositoryInterface
{


    public function getAll()
    {
        return Comment::get();
    }

    
   public function getCommentsByProprietaire()
{ 
    $proprietaireId = Auth::id();
    return Comment::with(['user', 'terrain'])
        ->whereHas('terrain', function($query) use ($proprietaireId) {
            $query->where('proprietaire_id', $proprietaireId);
        })
        ->get();
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
