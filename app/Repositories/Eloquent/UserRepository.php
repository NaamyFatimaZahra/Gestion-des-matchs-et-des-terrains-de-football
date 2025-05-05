<?php

namespace App\Repositories\Eloquent;

use App\Models\Role;
use App\Models\User;
use App\Repositories\Interface\UserRepositoryInterface;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    // Auth
      public function create(array $userData)
    {
        return User::create([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => Hash::make($userData['password']),
            'city' => $userData['city'],
            'role_id' => $userData['role_id'],
            'status' => $userData['role_id'] === 2 ? 'pending' : 'active',
            'profile_picture' => 'default.jpg'
        ]);
    }
    
    public function getRolesExceptAdmin()
    {
        return Role::where('name', '!=', 'Admin')->get();
    }
    
    public function findRoleIdByName($name)
    {
        return Role::where('name', '=', $name)->value('id');
    }
   


//   Profile
 public function updateUserProfile(int $userId, array $data)
    {
        $user = User::find($userId);
        
        if (!$user) {
            return false;
        }
        
        
        return $user->update($data);
    }
    
    public function updateProfilePicture(int $userId, string $path)
    {
        $user = User::find($userId);
        
        if (!$user) {
            return false;
        }
        $user->profile_picture=$path;
        
        
        return $user->save();
    }






















    public function getAllNonAdminUsers(): Collection
    {
        return User::with('role')
            ->whereHas('role', function($query) {
                $query->where('name', '!=', 'admin');
            })
            ->get();
    }
    
  
    public function updateStatus(User $user, string $status): bool
    {
        $user->status = $status;
        return $user->save();
    }
    
  
    public function findById(int $id)
    {
        return User::find($id);
    }

    
    public function getPlayers(): Collection
    {
        return User::whereHas('role', function($query) {
            $query->where('name', 'joueur');
        })->get();
    }
    public function getOwners(): Collection
    {
        return User::whereHas('role', function($query) {
            $query->where('name', 'proprietaire');
        })->get();
    }
    public function getPlayersByCity($city): Collection
    {
        return User::whereHas('role', function($query) {
            $query->where('name', 'joueur');
        })->where('city', $city)->where('status','active')->get();
    }

}