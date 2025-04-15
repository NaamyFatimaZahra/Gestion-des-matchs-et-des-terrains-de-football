<?php

namespace App\Http\Controllers\proprietaire;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Repositories\Eloquent\CommentRepository;
use App\Repositories\Interface\CommentRepositoryInterface;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $commentRepository;
 public function __construct(CommentRepositoryInterface $commentRepository)
 {
     $this->commentRepository = $commentRepository;
 }

    public function index()
    {
        $comments = $this->commentRepository->getAllComments();
        return view('proprietaire.comments', ['comments'=>$comments]);
    }

    public function destroy( Comment $comment)
    {
        if($this->commentRepository->isDeleted($comment)){
            return back()->with('success', 'Commentaire a ete deja supprime');
        }else{ 
            $comment = $this->commentRepository->deleteComment( $comment);
           if ($comment) {
           return back()->with('success', 'Comment deleted successfully');
        } else {
            return back()->with('error', 'Failed to delete comment');
        }
    }
}
}
