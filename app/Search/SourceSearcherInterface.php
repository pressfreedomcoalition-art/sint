<?php

declare(strict_types=1);

namespace App\Search;

interface SourceSearcherInterface
{
    public function getKey(): string;

    /**
     * @return array<int, array<string, mixed>>
     */
    public function searchByName(
        string $surname,
        ?string $firstname = null,
        ?string $patronymic = null,
        ?string $dob = null
    ): array;

    /**
     * @return array<int, array<string, mixed>>
     */
    public function searchByPhone(string $phone): array;

    /**
     * @return array<int, array<string, mixed>>
     */
    public function searchByEmail(string $email): array;

    public function supportsNameSearch(): bool;

    public function supportsPhoneSearch(): bool;

    public function supportsEmailSearch(): bool;
}
