<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Application;
use App\View\View;

final class IpsoUsersController
{
    private Application $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    private function requireAdmin(): void
    {
        if (($_SESSION['ipso_user']['role'] ?? '') !== 'admin') {
            header('location: ipso.php');
            exit;
        }
    }

    public function add(): void
    {
        $this->requireAdmin();

        if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['role'])) {
            $this->app->ipsoUsers()->create($_POST['login'], $_POST['password'], $_POST['role']);
        }

        View::renderLayout('ipso_admin', 'ipso/users_add', [
            'title' => 'Add User',
            'pageHeaderTitle' => 'Добавить юзера',
        ]);
    }

    public function list(): void
    {
        $this->requireAdmin();

        if (!empty($_GET['action']) && !empty($_GET['id']) && $_GET['action'] === 'delete') {
            $this->app->ipsoUsers()->deleteById((int) $_GET['id']);
            header('location: ipso_users_list.php');
            exit;
        }

        View::renderLayout('ipso_admin', 'ipso/users_list', [
            'title' => 'Users List',
            'pageHeaderTitle' => 'Users List',
            'users' => $this->app->ipsoUsers()->findAll(),
            'includeDatatables' => true,
        ]);
    }
}
