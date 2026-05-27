<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Application;
use App\View\View;

final class AddManualController
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

        $success = $this->app->manualInsertService()->handleSubmit($_POST);

        View::renderLayout('main', 'manual/form', [
            'title' => 'Add Manual',
            'pageHeaderTitle' => 'Добавить новую запись',
            'success' => $success,
        ]);
    }
}
