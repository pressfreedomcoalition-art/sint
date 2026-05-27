<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Application;
use App\View\View;

final class MyClientsController
{
    private Application $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function handle(): void
    {
        $role = (string) ($_SESSION['ipso_user']['role'] ?? '');
        if (!in_array($role, ['admin', 'ipsoshnik'], true)) {
            header('location: ipso.php');
            exit;
        }

        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $list = $this->app->personService()->listMyClients((int) $_SESSION['ipso_user']['id'], $page);

        View::renderLayout('ipso', 'ipso/list', [
            'title' => 'My Clients',
            'pageHeaderTitle' => 'Мои клиенты',
            'persons' => $list['persons'],
            'pagination' => $list['pagination'],
            'isAdmin' => $role === 'admin',
            'isIpso' => $role === 'ipsoshnik',
            'pageBaseUrl' => 'my_clients.php?',
            'listMode' => 'mine',
        ]);
    }
}

