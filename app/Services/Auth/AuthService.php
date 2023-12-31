<?php

namespace App\Services\Auth;

use App\Contracts\Abstracts\Services\BaseService;
use App\Contracts\Interfaces\Auth\AuthServiceInterface;
use Illuminate\Support\Facades\Auth;


class AuthService extends BaseService implements AuthServiceInterface
{
    /**
     * @param array $requestedData
     * @return array
     */
    public function authenticate(array $requestedData): array
    {
        $rememberme = false;
        if (isset($requestedData["rememberme"]) && $requestedData["rememberme"] === "on") {
            $rememberme = true;
            unset($requestedData["rememberme"]);
        }

        $response = Auth::attempt($requestedData, $rememberme) ?
            ["success" => true] :
            ["success" => false, "message" => "Invalid username or password"];
        return $response;
    }

    /**
     * @return array
     */
    public function getLoginData(): array
    {
        return [
            "title" => "Login"
        ];
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        Auth::logout();
    }
}
