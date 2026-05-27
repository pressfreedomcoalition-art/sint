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
        $statement = $this->pdo->prepare('UPDATE faggots SET user_id=?, assigned_ipso_user_id=? WHERE hash=? AND is_criminal=1');
        $statement->execute([$userId, $userId, $hash]);
    }

    public function unassign(string $hash): void
    {
        $statement = $this->pdo->prepare('UPDATE faggots SET user_id=?, assigned_ipso_user_id=? WHERE hash=? AND is_criminal=1');
        $statement->execute([null, null, $hash]);
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

    public function markCriminal(string $hash, bool $isCriminal): void
    {
        $statement = $this->pdo->prepare('UPDATE faggots SET is_criminal=? WHERE hash=?');
        $statement->execute([$isCriminal ? 1 : 0, $hash]);
    }

    public function countCriminalUnassigned(): int
    {
        return $this->countCriminalUnassignedFiltered(null, null);
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function findCriminalUnassignedByIdRange(int $fromId, int $toId): array
    {
        return $this->findCriminalUnassignedByIdRangeFiltered($fromId, $toId, null, null);
    }

    public function countCriminalByAssignee(int $ipsoUserId): int
    {
        return $this->countCriminalByAssigneeFiltered($ipsoUserId, null, null);
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function findCriminalByAssigneeIdRange(int $ipsoUserId, int $fromId, int $toId): array
    {
        return $this->findCriminalByAssigneeIdRangeFiltered($ipsoUserId, $fromId, $toId, null, null);
    }

    public function countCriminalUnassignedFiltered(?string $query, ?int $organizationId): int
    {
        $params = [];
        $join = '';
        $where = $this->buildCriminalFilterWhere(
            'assigned_ipso_user_id IS NULL',
            $params,
            $query,
            $organizationId,
            $join
        );

        $statement = $this->pdo->prepare("SELECT COUNT(DISTINCT f.id) AS c FROM faggots f {$join} WHERE {$where}");
        $statement->execute($params);
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        return (int) ($row['c'] ?? 0);
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function findCriminalUnassignedByIdRangeFiltered(
        int $fromId,
        int $toId,
        ?string $query,
        ?int $organizationId
    ): array {
        $params = [];
        $join = '';
        $where = $this->buildCriminalFilterWhere(
            'assigned_ipso_user_id IS NULL',
            $params,
            $query,
            $organizationId,
            $join
        );
        $where .= ' AND f.id BETWEEN ? AND ?';
        $params[] = $fromId;
        $params[] = $toId;

        $statement = $this->pdo->prepare(
            "SELECT DISTINCT f.* FROM faggots f {$join} WHERE {$where} ORDER BY f.id DESC"
        );
        $statement->execute($params);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countCriminalByAssigneeFiltered(int $ipsoUserId, ?string $query, ?int $organizationId): int
    {
        $params = [$ipsoUserId];
        $join = '';
        $where = $this->buildCriminalFilterWhere(
            'assigned_ipso_user_id = ?',
            $params,
            $query,
            $organizationId,
            $join
        );

        $statement = $this->pdo->prepare("SELECT COUNT(DISTINCT f.id) AS c FROM faggots f {$join} WHERE {$where}");
        $statement->execute($params);
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        return (int) ($row['c'] ?? 0);
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function findCriminalByAssigneeIdRangeFiltered(
        int $ipsoUserId,
        int $fromId,
        int $toId,
        ?string $query,
        ?int $organizationId
    ): array {
        $params = [$ipsoUserId];
        $join = '';
        $where = $this->buildCriminalFilterWhere(
            'assigned_ipso_user_id = ?',
            $params,
            $query,
            $organizationId,
            $join
        );
        $where .= ' AND f.id BETWEEN ? AND ?';
        $params[] = $fromId;
        $params[] = $toId;

        $statement = $this->pdo->prepare(
            "SELECT DISTINCT f.* FROM faggots f {$join} WHERE {$where} ORDER BY f.id DESC"
        );
        $statement->execute($params);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param array<int, mixed> $params
     */
    private function buildCriminalFilterWhere(
        string $assignedCondition,
        array &$params,
        ?string $query,
        ?int $organizationId,
        string &$join
    ): string {
        $join = '';
        $where = "f.is_criminal = 1 AND {$assignedCondition}";

        if ($organizationId !== null && $organizationId > 0) {
            $join .= ' INNER JOIN person_criminal_organizations pco ON pco.person_id = f.id';
            $where .= ' AND pco.organization_id = ?';
            $params[] = $organizationId;
        }

        if ($query !== null && $query !== '') {
            $where .= ' AND (f.fio LIKE ? OR f.dob LIKE ? OR f.hash LIKE ?)';
            $like = '%' . $query . '%';
            $params[] = $like;
            $params[] = $like;
            $params[] = $like;
        }

        return $where;
    }
}
