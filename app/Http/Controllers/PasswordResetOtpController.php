<?php

namespace App\Http\Controllers;

use App\Mail\PasswordResetOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PasswordResetOtpController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $email = $validated['email'];

        $otp = (string) random_int(100000, 999999);
        $cacheKey = 'password_reset_otp:' . sha1($email);

        Cache::put($cacheKey, Hash::make($otp), now()->addMinutes(10));

        try {
            Mail::to($email)->send(new PasswordResetOtp($otp, 10));
        } catch (\Throwable $exception) {
            report($exception);
            Cache::forget($cacheKey);

            return back()
                ->withErrors(['email' => 'Gagal mengirim email OTP. Cek konfigurasi SMTP.'])
                ->withInput();
        }

        return back()->with('status', 'Kode OTP sudah dikirim. Silakan cek inbox atau spam.');
    }
}
