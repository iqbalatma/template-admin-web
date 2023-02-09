<?php

namespace App\Interfaces\Auth;

use Illuminate\Http\Response;

interface AuthInterface
{
    public function authenticate(array $requestedData): array;
    public function logout(): void;
}
