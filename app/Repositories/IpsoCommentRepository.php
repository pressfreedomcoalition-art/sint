<?php

declare(strict_types=1);

namespace App\Repositories;

use PDO;

final class IpsoCommentRepository
{
    /** @var PDO */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function add(string $comment, string $userLogin, int $personId): void
    {
        $sql = 'INSERT INTO ipso_comments (comment, user, person_id, comment_date) VALUES (?,?,?,NOW())';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([$comment, $userLogin, $personId]);
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function findByPersonId(int $personId): array
    {
        $statement = $this->pdo->prepare('SELECT * FROM ipso_comments WHERE person_id=?');
        $statement->execute([$personId]);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
