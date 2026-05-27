<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Security\LegacyPasswordHasher;
use PDO;

final class IpsoUserRepository
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
    public function findByLoginAndPassword(string $login, string $plainPassword)
    {
        $statement = $this->pdo->prepare('SELECT * FROM ipso WHERE login=? AND password=?');
        $statement->execute([$login, LegacyPasswordHasher::hash($plainPassword)]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function findAll(): array
    {
        $statement = $this->pdo->prepare('SELECT * FROM ipso');
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(string $login, string $plainPassword, string $role): void
    {
        $statement = $this->pdo->prepare('INSERT INTO ipso (login, password, role) VALUES (?,?,?)');
        $statement->execute([$login, LegacyPasswordHasher::hash($plainPassword), $role]);
    }

    public function deleteById(int $id): void
    {
        $statement = $this->pdo->prepare('DELETE FROM ipso WHERE id=?');
        $statement->execute([$id]);
    }
}
