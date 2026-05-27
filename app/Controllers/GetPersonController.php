<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Application;

final class GetPersonController
{
    private Application $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function handle(): void
    {
        if (empty($_GET['hash'])) {
            return;
        }

        $output = $this->app->personExportService()->buildOutput($_GET['hash']);
        if ($output !== null) {
            echo json_encode($output);
        }
    }
}
