<?php

namespace App\Repositories\Interface;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
   public function updateProfilePicture( $user, string $picturePath): bool;
   public function updateUserProfile(int $userId, array $data): bool;
    public function getAllNonAdminUsers():LengthAwarePaginator;
   public function getFilteredUsers($typeFilter,$value);
   
    public function updateStatus(User $user, string $status): bool;
    
   
    public function findById(int $id);

    public function getPlayers(): Collection;

    public function getOwners(): Collection;
    public function getPlayersByCity(string $city): Collection;

}