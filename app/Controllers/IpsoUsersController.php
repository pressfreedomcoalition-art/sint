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

    private function currentRole(): string
    {
        return (string) ($_SESSION['ipso_user']['role'] ?? '');
    }

    private function requireAdminOrIpsoAdmin(): void
    {
        if (!in_array($this->currentRole(), ['admin', 'ipso_admin'], true)) {
            header('location: ipso.php');
            exit;
        }
    }

    public function add(): void
    {
        $this->requireAdminOrIpsoAdmin();

        $role = $this->currentRole();
        $allowedRolesToCreate = ['ipsoshnik'];
        if ($role === 'admin') {
            $allowedRolesToCreate = ['admin', 'ipso_admin', 'user', 'ipsoshnik'];
        }

        if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['role'])) {
            $newRole = (string) $_POST['role'];
            if (in_array($newRole, $allowedRolesToCreate, true)) {
                $this->app->ipsoUsers()->create($_POST['login'], $_POST['password'], $newRole);
            }
        }

        View::renderLayout('ipso_admin', 'ipso/users_add', [
            'title' => 'Add User',
            'pageHeaderTitle' => 'Добавить юзера',
            'allowedRolesToCreate' => $allowedRolesToCreate,
        ]);
    }

    public function list(): void
    {
        $this->requireAdminOrIpsoAdmin();

        $role = $this->currentRole();
        $canDeleteUsers = $role === 'admin';

        if ($canDeleteUsers && !empty($_GET['action']) && !empty($_GET['id']) && $_GET['action'] === 'delete') {
            $this->app->ipsoUsers()->deleteById((int) $_GET['id']);
            header('location: ipso_users_list.php');
            exit;
        }

        View::renderLayout('ipso_admin', 'ipso/users_list', [
            'title' => 'Users List',
            'pageHeaderTitle' => 'Users List',
            'users' => $this->app->ipsoUsers()->findAll(),
            'includeDatatables' => true,
            'canDeleteUsers' => $canDeleteUsers,
        ]);
    }
}
