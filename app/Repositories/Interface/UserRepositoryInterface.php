<?php

namespace App\Repositories\Interface;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
   public function updateProfilePicture( $user, string $picturePath): bool;
   public function updateUserProfile(int $userId, array $data): bool;
    public function getAllNonAdminUsers(): Collection;
    
   
    public function updateStatus(User $user, string $status): bool;
    
   
    public function findById(int $id);

    public function getPlayers(): Collection;

    public function getOwners(): Collection;
    public function getPlayersByCity(string $city): Collection;

}