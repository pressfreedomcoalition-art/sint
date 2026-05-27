<?php

declare(strict_types=1);

namespace App\Repositories;

use PDO;

final class SearchRequestRepository
{
    /** @var PDO */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param array<string, mixed> $resultPayload
     */
    public function create(int $userId, string $requestLabel, array $resultPayload, string $tags = ''): void
    {
        $sql = 'INSERT INTO search_requests (user_id, request, result, tags) VALUES (?,?,?,?)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            $userId,
            $requestLabel,
            json_encode($resultPayload),
            $tags,
        ]);
    }

    /**
     * @return array<string, mixed>|false
     */
    public function findById(int $id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM search_requests WHERE id=?');
        $statement->execute([$id]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function updateTags(int $id, string $tags): void
    {
        $statement = $this->pdo->prepare('UPDATE search_requests SET tags=? WHERE id=?');
        $statement->execute([$tags, $id]);
    }

    public function countAll(): int
    {
        $statement = $this->pdo->prepare('SELECT COUNT(*) FROM search_requests');
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        return (int) $row['COUNT(*)'];
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function findByUserIdRange(int $userId, int $fromId, int $toId): array
    {
        $statement = $this->pdo->prepare(
            'SELECT * FROM search_requests WHERE user_id=? AND id BETWEEN ? AND ? ORDER BY id DESC'
        );
        $statement->execute([$userId, $fromId, $toId]);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
