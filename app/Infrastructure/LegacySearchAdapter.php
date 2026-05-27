<?php

declare(strict_types=1);

namespace App\Infrastructure;

/**
 * Delegates to legacy functions in search_functions.php.
 * Replace methods one-by-one with dedicated SourceSearcher classes (stage 4).
 */
final class LegacySearchAdapter
{
    /**
     * @return array<int, array<string, mixed>>
     */
    public function searchEsiaByNameDob(
        string $surname,
        ?string $name = null,
        ?string $patronymic = null,
        ?string $dob = null
    ): array {
        return search_esia_by_name_dob($surname, $name, $patronymic, $dob);
    }

    /** @return array<int, array<string, mixed>> */
    public function searchRosreestrOwnersByNameDob(
        string $surname,
        ?string $name = null,
        ?string $patronymic = null,
        ?string $dob = null
    ): array {
        return search_rosreestr_owners_by_name_dob($surname, $name, $patronymic, $dob);
    }

    /** @return array<int, array<string, mixed>> */
    public function searchSirena2019ByNameDob(
        string $surname,
        ?string $name = null,
        ?string $patronymic = null,
        ?string $dob = null
    ): array {
        return search_sirena_2019_by_name_dob($surname, $name, $patronymic, $dob);
    }

    /** @return array<int, array<string, mixed>> */
    public function searchTomskBankByNameDob(
        string $surname,
        ?string $name = null,
        ?string $patronymic = null,
        ?string $dob = null
    ): array {
        return search_tomsk_bank_clients_kronos_2013_by_name_dob($surname, $name, $patronymic, $dob);
    }

    /** @return array<int, array<string, mixed>> */
    public function searchUnknown10kByNameDob(
        string $surname,
        ?string $name = null,
        ?string $patronymic = null,
        ?string $dob = null
    ): array {
        return search_unknown_10k_by_name_dob($surname, $name, $patronymic, $dob);
    }

    /** @return array<int, array<string, mixed>> */
    public function searchCovid19MoveByName(
        string $surname,
        ?string $name = null,
        ?string $patronymic = null
    ): array {
        return search_covid19_move_by_name($surname, $name, $patronymic);
    }

    /** @return array<int, array<string, mixed>> */
    public function searchManualInsertedByNameDob(
        string $surname,
        ?string $name = null,
        ?string $patronymic = null,
        ?string $dob = null
    ): array {
        return search_manual_inserted_by_name_dob($surname, $name, $patronymic, $dob);
    }

    /** @return array<int, array<string, mixed>> */
    public function searchPuma21ByNameDob(
        string $surname,
        ?string $name = null,
        ?string $patronymic = null,
        ?string $dob = null
    ): array {
        return search_puma21_by_name_dob($surname, $name, $patronymic, $dob);
    }

    /** @return array<int, array<string, mixed>> */
    public function searchSportmasterByNameDob(
        string $surname,
        ?string $name = null,
        ?string $patronymic = null,
        ?string $dob = null
    ): array {
        return search_sportmaster_by_name_dob($surname, $name, $patronymic, $dob);
    }

    /** @return array<int, array<string, mixed>> */
    public function searchGemotestByNameDob(
        string $surname,
        ?string $name = null,
        ?string $patronymic = null,
        ?string $dob = null
    ): array {
        return search_gemotest_by_name_dob($surname, $name, $patronymic, $dob);
    }

    /** @return array<int, array<string, mixed>> */
    public function searchEsiaByPhone(string $phone): array
    {
        return search_esia_by_phone($phone);
    }

    /** @return array<int, array<string, mixed>> */
    public function searchCovid19MoveByPhone(string $phone): array
    {
        return search_covid19_move_by_phone($phone);
    }

    /** @return array<int, array<string, mixed>> */
    public function searchPuma21ByPhone(string $phone): array
    {
        return search_puma21_by_phone($phone);
    }

    /** @return array<int, array<string, mixed>> */
    public function searchGetcontactByPhone(string $phone): array
    {
        return search_getcontact_by_phone($phone);
    }

    /** @return array<int, array<string, mixed>> */
    public function searchSportmasterByPhone(string $phone): array
    {
        return search_sportmaster_by_phone($phone);
    }

    /** @return array<int, array<string, mixed>> */
    public function searchGemotestByPhone(string $phone): array
    {
        return search_gemotest_by_phone($phone);
    }

    /** @return array<int, array<string, mixed>> */
    public function searchUnknown10kByPhone(string $phone): array
    {
        return search_unknown_10k_by_phone($phone);
    }

    /** @return array<int, array<string, mixed>> */
    public function searchManualInsertedByPhone(string $phone): array
    {
        return search_manual_inserted_by_phone($phone);
    }

    /** @return array<int, array<string, mixed>> */
    public function searchEsiaByEmail(string $email): array
    {
        return search_esia_by_email($email);
    }

    /** @return array<int, array<string, mixed>> */
    public function searchCovid19MoveByEmail(string $email): array
    {
        return search_covid19_move_by_email($email);
    }

    /** @return array<int, array<string, mixed>> */
    public function searchPuma21ByEmail(string $email): array
    {
        return search_puma21_by_email($email);
    }

    /** @return array<int, array<string, mixed>> */
    public function searchUnknown10kByEmail(string $email): array
    {
        return search_unknown_10k_by_email($email);
    }

    /** @return array<int, array<string, mixed>> */
    public function searchManualInsertedByEmail(string $email): array
    {
        return search_manual_inserted_by_email($email);
    }

    /** @return array<int, array<string, mixed>> */
    public function searchSportmasterByEmail(string $email): array
    {
        return search_sportmaster_by_email($email);
    }
}
