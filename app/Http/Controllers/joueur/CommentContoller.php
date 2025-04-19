<?php

namespace App\Http\Controllers\joueur;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\CommentRepository;
use App\Repositories\Interface\CommentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentContoller extends Controller
{
    protected $commentRepository;
    public function __construct(CommentRepositoryInterface $CommentRepository){
        $this->commentRepository = $CommentRepository;
    }
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:255',
            'rating' => 'required|integer|between:1,5',
            'terrain_id' => 'required|integer|exists:terrains,id',
        ]);
        
      
        $comment = $this->commentRepository->createComment($request->all());

        if ($comment) {
            return redirect()->back()->with('success', 'Commentaire ajouté avec succès.');
        } else {
            return redirect()->back()->with('error', 'Erreur lors de l\'ajout du commentaire.');
        }
    }
    public function destroy($id)
    {
        $comment = $this->commentRepository->findById($id);
        if( $this->commentRepository->deleteComment($comment)){
            return redirect()->back()->with('success', 'Commentaire supprimé avec succès.');
        }else{
            return redirect()->back()->with('error', 'Erreur lors de la suppression du commentaire.');
        }
     
    }
}
