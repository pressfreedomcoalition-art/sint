<?php

declare(strict_types=1);

namespace App\Search;

/**
 * Wraps legacy search_functions callables without changing SQL semantics.
 */
final class LegacyCallableSourceSearcher implements SourceSearcherInterface
{
    private string $key;

    /** @var callable */
    private $nameCallable;

    /** @var callable|null */
    private $phoneCallable;

    /** @var callable|null */
    private $emailCallable;

    /**
     * @param callable $nameCallable (surname, ?name, ?patronymic, ?dob) => array
     * @param callable|null $phoneCallable
     * @param callable|null $emailCallable
     */
    public function __construct(
        string $key,
        callable $nameCallable,
        ?callable $phoneCallable = null,
        ?callable $emailCallable = null
    ) {
        $this->key = $key;
        $this->nameCallable = $nameCallable;
        $this->phoneCallable = $phoneCallable;
        $this->emailCallable = $emailCallable;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function searchByName(
        string $surname,
        ?string $firstname = null,
        ?string $patronymic = null,
        ?string $dob = null
    ): array {
        return ($this->nameCallable)($surname, $firstname, $patronymic, $dob);
    }

    public function searchByPhone(string $phone): array
    {
        if ($this->phoneCallable === null) {
            return [];
        }

        return ($this->phoneCallable)($phone);
    }

    public function searchByEmail(string $email): array
    {
        if ($this->emailCallable === null) {
            return [];
        }

        return ($this->emailCallable)($email);
    }

    public function supportsNameSearch(): bool
    {
        return true;
    }

    public function supportsPhoneSearch(): bool
    {
        return $this->phoneCallable !== null;
    }

    public function supportsEmailSearch(): bool
    {
        return $this->emailCallable !== null;
    }
}
