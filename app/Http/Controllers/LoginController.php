<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\JwtService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function store(Request $request, JwtService $jwtService)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:9'],
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->hashed_password)) {
            return back()
                ->withErrors(['login' => 'Email atau password salah.'])
                ->withInput();
        }

        Auth::login($user);

        $token = $jwtService->generate($user);
        $ttlSeconds = $jwtService->ttlSeconds();

        if ($request->expectsJson()) {
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'expires_in' => $ttlSeconds,
            ]);
        }

        $request->session()->put('access_token', $token);

        return redirect()->route('dashboard');
    }
}
