<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Application;
use App\View\View;

final class CriminalPoolController
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
        $list = $this->app->personService()->listCriminalUnassigned($page);

        View::renderLayout('ipso', 'ipso/list', [
            'title' => 'Criminal Pool',
            'pageHeaderTitle' => 'Нераспределенные преступники',
            'persons' => $list['persons'],
            'pagination' => $list['pagination'],
            'isAdmin' => $role === 'admin',
            'isIpso' => $role === 'ipsoshnik',
            'pageBaseUrl' => 'criminals_pool.php?',
            'listMode' => 'pool',
        ]);
    }
}

