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
    public function findById($id)
    {
        return Comment::find($id);
    }

    public function createComment(array $data)
    {
    return Comment::create([
        'content' => $data['content'],
        'rating' => $data['rating'],
        'terrain_id' => $data['terrain_id'],
        'user_id' => Auth::id(), 
    ]);
    
   }

    
   public function getCommentsByProprietaire($perPage = 10)
{ 
    $proprietaireId = Auth::id();
    return Comment::with(['user', 'terrain'])
        ->whereHas('terrain', function($query) use ($proprietaireId) {
            $query->where('proprietaire_id', $proprietaireId);
        })
        ->orderBy('created_at', 'desc')
        ->paginate($perPage);
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
