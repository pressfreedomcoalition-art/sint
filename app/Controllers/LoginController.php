<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View\View;

final class LoginController
{
    public function handle(): void
    {
        global $login_error;

        View::render('auth/login', [
            'login_error' => $login_error,
        ]);
    }
}
