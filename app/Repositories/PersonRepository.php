<?php

declare(strict_types=1);

namespace App\Repositories;

use PDO;

final class PersonRepository
{
    /** @var PDO */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function countAll(): int
    {
        $statement = $this->pdo->prepare('SELECT COUNT(*) FROM faggots');
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        return (int) $row['COUNT(*)'];
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function findByIdRange(int $fromId, int $toId): array
    {
        $statement = $this->pdo->prepare(
            'SELECT * FROM faggots WHERE id BETWEEN ? AND ? ORDER BY id DESC'
        );
        $statement->execute([$fromId, $toId]);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return array<string, mixed>|false
     */
    public function findByHash(string $hash)
    {
        $statement = $this->pdo->prepare('SELECT * FROM faggots WHERE hash=?');
        $statement->execute([$hash]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function create(
        string $fio,
        string $dob,
        string $data,
        string $tags,
        string $comments,
        string $hash
    ): void {
        $sql = 'INSERT INTO faggots (fio, dob, data, tags, comments, hash) VALUES (?,?,?,?,?,?)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([$fio, $dob, $data, $tags, $comments, $hash]);
    }

    public function updateData(string $data, string $tags, string $comments, string $hash): void
    {
        $sql = 'UPDATE faggots SET data=?, tags=?, comments=? WHERE hash=?';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([$data, $tags, $comments, $hash]);
    }

    public function assignUser(int $userId, string $hash): void
    {
        $statement = $this->pdo->prepare('UPDATE faggots SET user_id=? WHERE hash=?');
        $statement->execute([$userId, $hash]);
    }

    public function unassign(string $hash): void
    {
        $statement = $this->pdo->prepare('UPDATE faggots SET user_id=? WHERE hash=?');
        $statement->execute([null, $hash]);
    }

    public function updateTags(string $tags, string $hash): void
    {
        $statement = $this->pdo->prepare('UPDATE faggots SET tags=? WHERE hash=?');
        $statement->execute([$tags, $hash]);
    }

    public function updateOrganizations(string $organizations, string $hash): void
    {
        $statement = $this->pdo->prepare('UPDATE faggots SET organizations=? WHERE hash=?');
        $statement->execute([$organizations, $hash]);
    }
}
