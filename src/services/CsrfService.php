<?php

declare(strict_types=1);

namespace App\Service;

/**
 * Generates and verifies per-form CSRF tokens stored in the PHP session.
 */
final class CsrfService
{
    public function getToken(string $formKey = 'default'): string
    {
        $this->ensureSessionStarted();

        if (
            !isset($_SESSION['_csrf'])
            || !is_array($_SESSION['_csrf'])
            || !isset($_SESSION['_csrf'][$formKey])
            || !is_string($_SESSION['_csrf'][$formKey])
            || $_SESSION['_csrf'][$formKey] === ''
        ) {
            $_SESSION['_csrf'][$formKey] = bin2hex(random_bytes(32));
        }

        return $_SESSION['_csrf'][$formKey];
    }

    public function validateToken(?string $token, string $formKey = 'default'): bool
    {
        $this->ensureSessionStarted();

        if (!is_string($token) || $token === '') {
            return false;
        }

        $expected = $_SESSION['_csrf'][$formKey] ?? null;
        if (!is_string($expected) || $expected === '') {
            return false;
        }

        return hash_equals($expected, $token);
    }

    private function ensureSessionStarted(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start([
                'cookie_httponly' => true,
                'cookie_samesite' => 'Lax',
            ]);
        }
    }
}
