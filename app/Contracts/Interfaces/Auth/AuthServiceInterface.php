<?php

namespace App\Contracts\Interfaces\Auth;


interface AuthServiceInterface
{
    public function authenticate(array $requestedData): array;
    public function logout(): void;
}
