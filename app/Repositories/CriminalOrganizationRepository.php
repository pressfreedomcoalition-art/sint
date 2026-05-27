<?php

declare(strict_types=1);

namespace App\Repositories;

use PDO;

final class CriminalOrganizationRepository
{
    /** @var PDO */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function findAll(): array
    {
        $statement = $this->pdo->prepare('SELECT id, name FROM criminal_organizations ORDER BY name');
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(string $name): void
    {
        $statement = $this->pdo->prepare('INSERT INTO criminal_organizations (name) VALUES (?)');
        $statement->execute([$name]);
    }

    public function update(int $id, string $name): void
    {
        $statement = $this->pdo->prepare('UPDATE criminal_organizations SET name=? WHERE id=?');
        $statement->execute([$name, $id]);
    }

    public function delete(int $id): void
    {
        $statement = $this->pdo->prepare('DELETE FROM person_criminal_organizations WHERE organization_id=?');
        $statement->execute([$id]);

        $statement = $this->pdo->prepare('DELETE FROM criminal_organizations WHERE id=?');
        $statement->execute([$id]);
    }

    /**
     * @return array<int, int>
     */
    public function findOrganizationIdsByPersonId(int $personId): array
    {
        $statement = $this->pdo->prepare(
            'SELECT organization_id FROM person_criminal_organizations WHERE person_id=?'
        );
        $statement->execute([$personId]);
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

        return array_map(static fn (array $r): int => (int) $r['organization_id'], $rows);
    }

    /**
     * @return array<int, string>
     */
    public function findNamesByPersonId(int $personId): array
    {
        $statement = $this->pdo->prepare(
            'SELECT co.name
             FROM person_criminal_organizations pco
             INNER JOIN criminal_organizations co ON co.id = pco.organization_id
             WHERE pco.person_id=?
             ORDER BY co.name'
        );
        $statement->execute([$personId]);
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

        return array_map(static fn (array $r): string => (string) $r['name'], $rows);
    }

    /**
     * @param array<int, int> $organizationIds
     */
    public function replacePersonOrganizations(int $personId, array $organizationIds): void
    {
        $statement = $this->pdo->prepare('DELETE FROM person_criminal_organizations WHERE person_id=?');
        $statement->execute([$personId]);

        $insert = $this->pdo->prepare(
            'INSERT INTO person_criminal_organizations (person_id, organization_id) VALUES (?, ?)'
        );
        foreach ($organizationIds as $organizationId) {
            $insert->execute([$personId, $organizationId]);
        }
    }
}

