<?php

/**
 * Legacy include — prefer dispatch.php / Router for new code.
 */
ob_start();
session_start();

if (!isset($pdo)) {
    require_once __DIR__ . '/config.php';
}

require_once __DIR__ . '/bootstrap.php';

use App\Application;
use App\Services\AuthGate;

AuthGate::run(
    Application::fromGlobals()->ipsoUsers(),
    Application::fromGlobals()->tokenUsers(),
    $_GET,
    $_POST
);
