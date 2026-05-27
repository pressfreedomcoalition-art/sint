<?php

declare(strict_types=1);

namespace App\Security;

/** Preserves legacy double SHA-256 for ipso passwords. */
final class LegacyPasswordHasher
{
    public static function hash(string $plain): string
    {
        return hash('sha256', hash('sha256', $plain));
    }
}
