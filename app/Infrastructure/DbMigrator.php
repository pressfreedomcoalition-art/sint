<?php

declare(strict_types=1);

namespace App\Infrastructure;

use PDO;
use Throwable;

final class DbMigrator
{
    /** @var PDO */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function run(array $queries): void
    {
        $this->pdo->exec(
            "CREATE TABLE IF NOT EXISTS settings (
                id INT PRIMARY KEY,
                last_migration_index INT NOT NULL DEFAULT -1
            )"
        );
        $this->pdo->exec(
            "INSERT INTO settings (id, last_migration_index)
             SELECT 1, -1 FROM DUAL
             WHERE NOT EXISTS (SELECT 1 FROM settings WHERE id = 1)"
        );

        $lastIndex = $this->getLastMigrationIndex();
        foreach ($queries as $index => $sql) {
            if ($index <= $lastIndex) {
                continue;
            }

            try {
                $this->pdo->exec($sql);
                $this->setLastMigrationIndex((int) $index);
            } catch (Throwable $e) {
                // Stop at first failing migration to keep deterministic order.
                break;
            }
        }
    }

    private function getLastMigrationIndex(): int
    {
        $statement = $this->pdo->prepare('SELECT last_migration_index FROM settings WHERE id=1');
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        return (int) ($row['last_migration_index'] ?? -1);
    }

    private function setLastMigrationIndex(int $index): void
    {
        $statement = $this->pdo->prepare('UPDATE settings SET last_migration_index=? WHERE id=1');
        $statement->execute([$index]);
    }
}

