<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\SendEmailConfirmation;
use App\Models\User;
use App\Repositories\Interface\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    protected $userRepository;
    
  
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
   
    public function index()
    {
        $users = $this->userRepository->getAllNonAdminUsers();
        return view('admin.users.index', ['users' => $users]);
    }
    
     public function filter($type, $value)
    {
        $transformedUsers=$this->userRepository->getFilteredUsers($type,$value);

        return response()->json($transformedUsers);
    }
    public function updateStatus(Request $request, User $user)
    {
        $request->validate([
            'status' => 'required|in:active,suspended',
        ]);
        
        if ($user->status === 'pending' && $request->status === 'active') {
            Mail::to($user->email)->send(new SendEmailConfirmation());
        }
        
        $this->userRepository->updateStatus($user, $request->status);
        
        return redirect()->back()->with('success', 'Statut de l\'utilisateur mis à jour avec succès.');
    }
    
   
    public function details($id)
    {
        $user = $this->userRepository->findById($id);
        return view('admin.users.detailsUser', ['user' => $user]);
    }
}