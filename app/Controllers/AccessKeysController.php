<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Application;
use App\View\View;

final class AccessKeysController
{
    private Application $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function handle(): void
    {
        if (($_SESSION['ipso_user']['role'] ?? '') !== 'admin') {
            header('location: ipso.php');
            exit;
        }

        $repo = $this->app->accessKeys();
        $repo->ensureSchema();

        if (!empty($_POST['create_key']) && !empty($_POST['access_status'])) {
            $status = $this->sanitizeStatus((string) $_POST['access_status']);
            if ($status !== null) {
                $repo->create(bin2hex(random_bytes(16)), $status);
            }
        }

        if (!empty($_POST['update_status']) && !empty($_POST['id']) && !empty($_POST['access_status'])) {
            $status = $this->sanitizeStatus((string) $_POST['access_status']);
            if ($status !== null) {
                $repo->updateStatus((int) $_POST['id'], $status);
            }
        }

        View::renderLayout('ipso_admin', 'access_keys/list', [
            'title' => 'Access Keys',
            'pageHeaderTitle' => 'Ключи доступа',
            'keys' => $repo->findAll(),
            'statusOptions' => ['admin', 'user', 'blocked'],
        ]);
    }

    private function sanitizeStatus(string $status): ?string
    {
        if (!in_array($status, ['admin', 'user', 'blocked'], true)) {
            return null;
        }

        return $status;
    }
}

