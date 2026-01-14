<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:9'],
        ]);

        User::create([
            'email' => $validated['email'],
            'hashed_password' => Hash::make($validated['password']),
        ]);

        return redirect()
            ->route('auth', ['page' => 'masuk'])
            ->with('status', 'Akun berhasil dibuat. Silakan masuk.');
    }
}
