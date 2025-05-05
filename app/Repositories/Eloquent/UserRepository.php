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
   


























    
    public function updateProfilePicture(User $user, string $picturePath): bool
{
    $user->profile_picture = $picturePath;
    return $user->save();
}
   public function updateUserProfile(int $userId, array $data): bool
{
        $user = User::findOrFail($userId);
        
        // Mettre à jour les attributs
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->city = $data['city'] ?? $user->city;
        $user->phone_number = $data['phone_number'] ?? $user->phone_number;
        $user->bio = $data['bio'] ?? $user->bio;
        
       
        if ($user->save()) {
            return true;
        } else {
            return false;
        }
    
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