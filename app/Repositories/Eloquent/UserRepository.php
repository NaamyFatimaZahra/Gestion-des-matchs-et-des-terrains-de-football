<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Interface\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository implements UserRepositoryInterface
{

    public function updateProfilePicture($user, string $picturePath): bool
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
    public function getAllNonAdminUsers(): LengthAwarePaginator
    {
        return User::with('role')
            ->whereHas('role', function ($query) {
                $query->where('name', '!=', 'admin');
            })
            ->paginate(4);
    }
    public function getFilteredUsers($typeFilter, $value)
    {
        $users = User::query();

        if ($typeFilter == 'role') {
            $users = User::where('role_id', $value);
        } elseif ($typeFilter == 'status') {
            $users = User::where('status', $value);
        }else if ($typeFilter == 'clear') {
        }

        $filteredUsers = $users->with(['role'])->where('role_id', '!=', 1)->get();

        return $filteredUsers;
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
        return User::whereHas('role', function ($query) {
            $query->where('name', 'joueur');
        })->get();
    }
    public function getOwners(): Collection
    {
        return User::whereHas('role', function ($query) {
            $query->where('name', 'proprietaire');
        })->get();
    }
    public function getPlayersByCity($city): Collection
    {
        return User::whereHas('role', function ($query) {
            $query->where('name', 'joueur');
        })->where('city', $city)->where('status', 'active')->get();
    }
}
