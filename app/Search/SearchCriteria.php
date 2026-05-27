<?php

declare(strict_types=1);

namespace App\Search;

/**
 * HTTP search input (POST fields). Field names match legacy forms.
 */
final class SearchCriteria
{
    public ?string $surname = null;
    public ?string $firstname = null;
    public ?string $patronymic = null;
    /** @var string|null Date of birth (POST key DOB) */
    public ?string $dob = null;
    public ?string $phone = null;
    public ?string $email = null;

    public static function fromPost(array $post): self
    {
        $c = new self();
        $c->surname = self::nonEmptyString($post['surname'] ?? null);
        $c->firstname = self::nonEmptyString($post['firstname'] ?? null);
        $c->patronymic = self::nonEmptyString($post['patronymic'] ?? null);
        $c->dob = self::nonEmptyString($post['DOB'] ?? null);
        $c->phone = self::nonEmptyString($post['phone'] ?? null);
        $c->email = self::nonEmptyString($post['email'] ?? null);

        return $c;
    }

    public function hasSurnameSearch(): bool
    {
        return $this->surname !== null;
    }

    public function hasPhoneSearch(): bool
    {
        return $this->phone !== null;
    }

    public function hasEmailSearch(): bool
    {
        return $this->email !== null;
    }

    private static function nonEmptyString($value): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        return (string) $value;
    }
}
