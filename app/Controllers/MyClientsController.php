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
        $query = isset($_GET['q']) ? trim((string) $_GET['q']) : null;
        $orgId = isset($_GET['org_id']) && $_GET['org_id'] !== '' ? (int) $_GET['org_id'] : null;
        $list = $this->app->personService()->listMyClientsFiltered(
            (int) $_SESSION['ipso_user']['id'],
            $page,
            $query,
            $orgId
        );
        $queryTail = '';
        if ($query !== null && $query !== '') {
            $queryTail .= '&q=' . urlencode($query);
        }
        if ($orgId !== null && $orgId > 0) {
            $queryTail .= '&org_id=' . $orgId;
        }

        View::renderLayout('ipso', 'ipso/list', [
            'title' => 'My Clients',
            'pageHeaderTitle' => 'Мои клиенты',
            'persons' => $list['persons'],
            'pagination' => $list['pagination'],
            'isAdmin' => $role === 'admin',
            'isIpso' => $role === 'ipsoshnik',
            'pageBaseUrl' => 'my_clients.php?' . ltrim($queryTail . '&', '&'),
            'listMode' => 'mine',
            'searchQuery' => $query ?? '',
            'selectedOrgId' => $orgId ?? 0,
            'organizationCatalog' => $this->app->criminalOrganizations()->findAll(),
        ]);
    }
}

