<?php

namespace App\Services;

use App\Models\User;

class JwtService
{
    public function generate(User $user): string
    {
        $header = [
            'alg' => 'HS256',
            'typ' => 'JWT',
        ];

        $issuedAt = time();
        $payload = [
            'sub' => (string) $user->id,
            'email' => $user->email,
            'iat' => $issuedAt,
            'exp' => $issuedAt + $this->ttlSeconds(),
        ];

        $segments = [
            $this->base64UrlEncode(json_encode($header, JSON_UNESCAPED_SLASHES)),
            $this->base64UrlEncode(json_encode($payload, JSON_UNESCAPED_SLASHES)),
        ];

        $signature = hash_hmac('sha256', implode('.', $segments), $this->secret(), true);
        $segments[] = $this->base64UrlEncode($signature);

        return implode('.', $segments);
    }

    public function ttlSeconds(): int
    {
        return (int) config('auth.jwt_ttl', 30) * 60;
    }

    private function secret(): string
    {
        $key = (string) config('app.key');
        if (str_starts_with($key, 'base64:')) {
            $decoded = base64_decode(substr($key, 7), true);
            if ($decoded !== false) {
                return $decoded;
            }
        }

        return $key;
    }

    private function base64UrlEncode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
}
