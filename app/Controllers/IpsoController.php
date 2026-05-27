<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Application;
use App\View\View;

final class IpsoController
{
    private Application $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function handle(): void
    {
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $list = $this->app->personService()->listPaginated($page);
        $isAdmin = ($_SESSION['ipso_user']['role'] ?? '') === 'admin';

        View::renderLayout('ipso', 'ipso/list', [
            'title' => 'Results',
            'pageHeaderTitle' => 'Данные',
            'persons' => $list['persons'],
            'pagination' => $list['pagination'],
            'isAdmin' => $isAdmin,
            'pageBaseUrl' => 'ipso.php?',
        ]);
    }
}
