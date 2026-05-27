<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Application;
use App\View\View;

final class CriminalOrganizationsController
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

        $repo = $this->app->criminalOrganizations();

        if (!empty($_POST['create_org']) && !empty($_POST['name'])) {
            $repo->create(trim((string) $_POST['name']));
        }

        if (!empty($_POST['update_org']) && !empty($_POST['id']) && !empty($_POST['name'])) {
            $repo->update((int) $_POST['id'], trim((string) $_POST['name']));
        }

        if (!empty($_POST['delete_org']) && !empty($_POST['id'])) {
            $repo->delete((int) $_POST['id']);
        }

        View::renderLayout('ipso_admin', 'criminal_organizations/list', [
            'title' => 'Criminal Organizations',
            'pageHeaderTitle' => 'Преступные организации',
            'organizations' => $repo->findAll(),
        ]);
    }
}

