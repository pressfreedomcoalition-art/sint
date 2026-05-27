<?php

declare(strict_types=1);

namespace App\Http;

use App\Application;
use App\Services\AuthGate;

final class Router
{
    /** @var array<string, array{0: string, 1: string, 2: string}> route => [controller factory method, action, auth: token|ipso|none|auth_file] */
    private const ROUTES = [
        'search' => ['searchController', 'handle', 'token'],
        'search_request' => ['searchRequestController', 'handle', 'token'],
        'search_results' => ['searchResultsController', 'handle', 'token'],
        'login' => ['loginController', 'handle', 'ipso'],
        'ipso' => ['ipsoController', 'handle', 'ipso'],
        'single_person' => ['singlePersonController', 'handle', 'ipso'],
        'ipso_users' => ['ipsoUsersController', 'add', 'ipso'],
        'ipso_users_list' => ['ipsoUsersController', 'list', 'ipso'],
        'access_keys' => ['accessKeysController', 'handle', 'ipso'],
        'add_manual' => ['addManualController', 'handle', 'none'],
        'getperson' => ['getPersonController', 'handle', 'none'],
    ];

    public static function dispatch(string $route): void
    {
        if (!isset(self::ROUTES[$route])) {
            http_response_code(404);
            echo 'PAGE NOT FOUND';

            return;
        }

        [$factory, $action, $authMode] = self::ROUTES[$route];
        $app = Application::fromGlobals();

        if ($authMode === 'token' || $authMode === 'ipso') {
            if (session_status() !== PHP_SESSION_ACTIVE) {
                ob_start();
                session_start();
            }
            AuthGate::run(
                $app->ipsoUsers(),
                $app->tokenUsers(),
                $_GET,
                $_POST
            );
        }

        $controller = self::resolveController($app, $factory);
        $controller->$action();
    }

    private static function resolveController(Application $app, string $factory): object
    {
        if (!method_exists($app, $factory)) {
            throw new \RuntimeException('Unknown controller factory: ' . $factory);
        }

        return $app->$factory();
    }
}
