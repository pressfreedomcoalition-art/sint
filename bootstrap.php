<?php

declare(strict_types=1);

/**
 * Application bootstrap. Include once from entry scripts.
 */
if (!defined('SINT_ROOT')) {
    define('SINT_ROOT', __DIR__);
}

if (!isset($pdo)) {
    require_once SINT_ROOT . '/config.php';
}

require_once SINT_ROOT . '/search_functions.php';
require_once SINT_ROOT . '/app/Infrastructure/Autoloader.php';

\App\Infrastructure\Autoloader::register(SINT_ROOT . '/app');
