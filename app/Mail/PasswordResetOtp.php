<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetOtp extends Mailable
{
    use Queueable, SerializesModels;

    public string $otp;
    public int $minutes;

    public function __construct(string $otp, int $minutes)
    {
        $this->otp = $otp;
        $this->minutes = $minutes;
    }

    public function build()
    {
        return $this->subject('Kode OTP Reset Password')
            ->view('auth', ['page' => 'password-reset-otp']);
    }
}
