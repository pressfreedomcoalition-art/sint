<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\IpsoUserRepository;
use App\Repositories\TokenUserRepository;

/**
 * Legacy auth.php behaviour: token users or IPso session.
 * Sets $login_error and $user in global scope for entry scripts.
 */
final class AuthGate
{
    public static function run(
        IpsoUserRepository $ipsoUsers,
        TokenUserRepository $tokenUsers,
        array $get,
        array $post
    ): void {
        global $login_error, $user;

        $login_error = null;

        if (empty($get['token'])) {
            if (!empty($post['login']) && !empty($post['password'])) {
                $ipsoUser = $ipsoUsers->findByLoginAndPassword($post['login'], $post['password']);
                if ($ipsoUser === false) {
                    $login_error = 'Неверный логин или пароль';
                } else {
                    $_SESSION['ipso_user'] = $ipsoUser;
                    header('location: ipso.php');
                    exit;
                }
            } elseif ((empty($get['page']) || $get['page'] !== 'login') && !isset($_SESSION['ipso_user'])) {
                die('PAGE NOT FOUND');
            }
        } else {
            $user = $tokenUsers->findByToken($get['token']);
            if ($user === false) {
                die('PAGE NOT FOUND');
            }
            $status = (string) ($user['access_status'] ?? 'user');
            if ($status === 'blocked') {
                die('ACCESS BLOCKED');
            }
        }
    }
}
