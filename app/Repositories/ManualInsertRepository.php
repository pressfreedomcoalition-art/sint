<?php

declare(strict_types=1);

namespace App\Repositories;

use PDO;

final class ManualInsertRepository
{
    /** @var PDO */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function insert(
        string $surname,
        string $firstname,
        string $patronymic,
        string $dob,
        string $emails,
        string $phones,
        string $addresses,
        string $socialnetworks,
        string $additionalInfo,
        string $tags
    ): void {
        $sql = 'INSERT INTO manual_inserted (surname,firstname,patronymic,dob,emails,phones,addresses,socialnetworks,additional_info,tags) VALUES (?,?,?,?,?,?,?,?,?,?)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            $surname,
            $firstname,
            $patronymic,
            $dob,
            $emails,
            $phones,
            $addresses,
            $socialnetworks,
            $additionalInfo,
            $tags,
        ]);
    }
}
