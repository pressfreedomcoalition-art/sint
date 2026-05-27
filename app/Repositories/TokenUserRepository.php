<?php

declare(strict_types=1);

namespace App\Repositories;

use PDO;

final class TokenUserRepository
{
    /** @var PDO */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return array<string, mixed>|false
     */
    public function findByToken(string $token)
    {
        $statement = $this->pdo->prepare('SELECT * FROM users WHERE token=?');
        $statement->execute([$token]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}
