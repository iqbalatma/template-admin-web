<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthenticateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        $data = [
            "title" => "Login"
        ];
        return view('auth.login', $data);
    }

    public function authenticate(AuthenticateRequest $request): RedirectResponse
    {
        if (Auth::attempt($request->only("email", "password"), $request->input('rememberme', false))) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->with('failed', 'Username or password is invalid',)->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route("auth.login");
    }
}
