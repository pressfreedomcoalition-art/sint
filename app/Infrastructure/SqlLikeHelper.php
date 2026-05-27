<?php

declare(strict_types=1);

namespace App\Infrastructure;

/**
 * Helpers for safer LIKE queries (stage 6). Use when migrating SQL from string concat.
 */
final class SqlLikeHelper
{
    public static function wrapContains(string $value): string
    {
        return '%' . self::escapeLikeWildcards($value) . '%';
    }

    public static function escapeLikeWildcards(string $value): string
    {
        return str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], $value);
    }
}
