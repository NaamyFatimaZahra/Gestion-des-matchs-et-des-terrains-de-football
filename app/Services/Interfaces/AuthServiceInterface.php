<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface AuthServiceInterface
{
    public function attemptLogin(array $credentials, bool $remember);
    public function register(array $userData);
    public function logout(Request $request);
    public function getRedirectPath($user);
    public function getRoles();
}