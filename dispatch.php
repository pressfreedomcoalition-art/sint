<?php

if (!isset($pdo)) {
    require_once __DIR__ . '/config.php';
}

require_once __DIR__ . '/bootstrap.php';

use App\Http\Router;

$route = defined('SINT_ROUTE') ? SINT_ROUTE : pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_FILENAME);

if ($route === 'index' || $route === 'f') {
    $route = 'search';
}

if ($route === 'login' && empty($_GET['page'])) {
    $_GET['page'] = 'login';
}

Router::dispatch($route);
