<?php

declare(strict_types=1);

namespace App\Repositories;

use PDO;

final class AccessKeyRepository
{
    /** @var PDO */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Best-effort schema migration for access status support.
     */
    public function ensureSchema(): void
    {
        try {
            $this->pdo->exec("ALTER TABLE users ADD COLUMN access_status VARCHAR(16) NOT NULL DEFAULT 'user'");
        } catch (\Throwable $e) {
            // Column may already exist.
        }
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function findAll(): array
    {
        $statement = $this->pdo->prepare(
            "SELECT id, token, access_status FROM users ORDER BY id DESC"
        );
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(string $token, string $accessStatus): void
    {
        $statement = $this->pdo->prepare(
            "INSERT INTO users (token, access_status) VALUES (?, ?)"
        );
        $statement->execute([$token, $accessStatus]);
    }

    public function updateStatus(int $id, string $accessStatus): void
    {
        $statement = $this->pdo->prepare(
            "UPDATE users SET access_status=? WHERE id=?"
        );
        $statement->execute([$accessStatus, $id]);
    }
}

