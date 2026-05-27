<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Application;
use App\View\View;

final class SinglePersonController
{
    private Application $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function handle(): void
    {
        if (empty($_GET['hash'])) {
            header('location: ipso.php');
            exit;
        }

        $detail = $this->app->personService()->handleDetail(
            $_GET['hash'],
            $_GET,
            $_POST,
            $_SESSION['ipso_user']
        );

        if ($detail === null) {
            header('location: ipso.php');
            exit;
        }

        View::renderLayout('ipso_person', 'ipso/single_person', array_merge($detail, [
            'title' => '',
            'pageHeaderTitle' => 'Данные на  ' . $detail['person']['fio'] . ' ' . $detail['person']['dob'],
            'hash' => $_GET['hash'],
        ]));
    }
}
