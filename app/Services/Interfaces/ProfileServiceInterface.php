<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface ProfileServiceInterface
{
    public function getUserProfile();
    public function updateUserProfile(array $data);
    public function updateProfilePicture(Request $request);
}