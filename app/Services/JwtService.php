<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class JwtService
{
    /**
     * Generate a standard RFC 7519 JWT token (HS256) for a User (Customer or Admin).
     */
    public static function generateToken(User $user, int $ttlSeconds = 604800): string
    {
        $header = [
            'alg' => 'HS256',
            'typ' => 'JWT',
        ];

        $now = time();
        $payload = [
            'iss' => config('app.url', 'http://127.0.0.1:8000'),
            'sub' => $user->id,
            'id_customer' => $user->id,
            'nama_customer' => $user->name,
            'email' => $user->email,
            'no_telpon' => $user->no_telpon,
            'role' => $user->role ?? 'customer',
            'iat' => $now,
            'exp' => $now + $ttlSeconds,
        ];

        $base64UrlHeader = self::base64UrlEncode(json_encode($header));
        $base64UrlPayload = self::base64UrlEncode(json_encode($payload));

        $signature = hash_hmac(
            'sha256',
            $base64UrlHeader . '.' . $base64UrlPayload,
            self::getSecretKey(),
            true
        );
        $base64UrlSignature = self::base64UrlEncode($signature);

        return $base64UrlHeader . '.' . $base64UrlPayload . '.' . $base64UrlSignature;
    }

    /**
     * Verify and decode a JWT token. Returns payload array or null if invalid/expired.
     */
    public static function verifyToken(?string $token): ?array
    {
        if (!$token) {
            return null;
        }

        $parts = explode('.', $token);
        if (count($parts) !== 3) {
            return null;
        }

        [$header64, $payload64, $signature64] = $parts;

        $expectedSignature = self::base64UrlEncode(
            hash_hmac('sha256', $header64 . '.' . $payload64, self::getSecretKey(), true)
        );

        if (!hash_equals($expectedSignature, $signature64)) {
            return null;
        }

        $payload = json_decode(self::base64UrlDecode($payload64), true);
        if (!is_array($payload)) {
            return null;
        }

        if (isset($payload['exp']) && time() > $payload['exp']) {
            return null;
        }

        return $payload;
    }

    /**
     * Extract authenticated User from Request Authorization: Bearer <token> header.
     */
    public static function userFromRequest(Request $request): ?User
    {
        $token = $request->bearerToken() ?: $request->input('token');
        $payload = self::verifyToken($token);

        if (!$payload || empty($payload['sub'])) {
            return null;
        }

        return User::with(['dataUser', 'alamatCustomers'])->find($payload['sub']);
    }

    private static function getSecretKey(): string
    {
        $key = config('app.key', 'koafy-jwt-secret-key-2026');
        if (str_starts_with($key, 'base64:')) {
            return base64_decode(substr($key, 7));
        }
        return $key;
    }

    private static function base64UrlEncode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private static function base64UrlDecode(string $data): string
    {
        $remainder = strlen($data) % 4;
        if ($remainder) {
            $data .= str_repeat('=', 4 - $remainder);
        }
        return base64_decode(strtr($data, '-_', '+/'));
    }
}
