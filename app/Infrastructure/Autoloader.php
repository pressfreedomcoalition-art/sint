<?php

declare(strict_types=1);

namespace App\Infrastructure;

final class Autoloader
{
    public static function register(string $appDir): void
    {
        spl_autoload_register(static function (string $class) use ($appDir): void {
            $prefix = 'App\\';
            if (strncmp($class, $prefix, strlen($prefix)) !== 0) {
                return;
            }
            $relative = substr($class, strlen($prefix));
            $path = $appDir . '/' . str_replace('\\', '/', $relative) . '.php';
            if (is_file($path)) {
                require_once $path;
            }
        });
    }
}
