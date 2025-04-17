<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\SendEmailConfirmation;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index(){
           $users = User::with('role')
                ->whereHas('role', function($query) {
                    $query->where('name', '!=', 'admin');
                   
                })
                ->get();
        return view('admin.users.index',['users'=>$users]);
    }

            public function updateStatus(Request $request, User $user)
        {
           
            $request->validate([
                'status' => 'required|in:active,suspended',
            ]);
            if($user->status==='pending' && $request->status==='active'){
                $usermail=$user->email;
                Mail::to( $usermail)->send(new SendEmailConfirmation());
            }
            $user->status = $request->status;
            $user->save();

            return redirect()->back()->with('success', 'Statut de l\'utilisateur mis à jour avec succès.');
        }
        public function details($id){
            $user=User::find($id);
           return view('admin.users.detailsUser',['user'=>$user]);
    }
        
}
