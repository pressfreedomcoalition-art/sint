<?php

declare(strict_types=1);

namespace App\Services;

use App\Infrastructure\LegacySearchAdapter;

/**
 * Synchronous search (legacy search.php POST). Uses isset semantics, does not persist.
 *
 * @return array{results: array<string, array<int, array<string, mixed>>>, sourceCount: int}|null
 */
final class SyncSearchOrchestrator
{
    private LegacySearchAdapter $search;

    public function __construct(LegacySearchAdapter $search)
    {
        $this->search = $search;
    }

    /**
     * @param array<string, mixed> $post
     * @return array{results: array<string, array<int, array<string, mixed>>>, sourceCount: int}|null
     */
    public function execute(array $post): ?array
    {
        if (!isset($post['surname']) && !isset($post['phone']) && !isset($post['email'])) {
            return null;
        }

        if (isset($post['surname'])) {
            return $this->searchBySurname($post);
        }
        if (isset($post['phone'])) {
            return $this->searchByPhone($post);
        }

        return $this->searchByEmail($post);
    }

    /**
     * @param array<string, mixed> $post
     * @return array{results: array<string, array<int, array<string, mixed>>>, sourceCount: int}
     */
    private function searchBySurname(array $post): array
    {
        $surname = (string) $post['surname'];
        $results = [];

        if (isset($post['firstname']) && isset($post['patronymic']) && isset($post['DOB'])) {
            $results = [
                'esia' => $this->search->searchEsiaByNameDob($surname, $post['firstname'], $post['patronymic'], $post['DOB']),
                'rosreestr_owners' => $this->search->searchRosreestrOwnersByNameDob($surname, $post['firstname'], $post['patronymic'], $post['DOB']),
                'sirena_2019' => $this->search->searchSirena2019ByNameDob($surname, $post['firstname'], $post['patronymic'], $post['DOB']),
                'tomsk_bank_clients_kronos_2013' => $this->search->searchTomskBankByNameDob($surname, $post['firstname'], $post['patronymic'], $post['DOB']),
                'unknown_10k' => $this->search->searchUnknown10kByNameDob($surname, $post['firstname'], $post['patronymic'], $post['DOB']),
                'covid19_move' => $this->search->searchCovid19MoveByName($surname, $post['firstname'], $post['patronymic']),
                'manual_inserted' => $this->search->searchManualInsertedByNameDob($surname, $post['firstname'], $post['patronymic'], $post['DOB']),
                'puma21' => $this->search->searchPuma21ByNameDob($surname, $post['firstname'], $post['patronymic'], $post['DOB']),
                'sportmaster' => $this->search->searchSportmasterByNameDob($surname, $post['firstname'], $post['patronymic'], $post['DOB']),
                'gemotest' => $this->search->searchGemotestByNameDob($surname, $post['firstname'], $post['patronymic'], $post['DOB']),
            ];
        } elseif (isset($post['firstname']) && isset($post['patronymic'])) {
            $results = [
                'esia' => $this->search->searchEsiaByNameDob($surname, $post['firstname'], $post['patronymic']),
                'rosreestr_owners' => $this->search->searchRosreestrOwnersByNameDob($surname, $post['firstname'], $post['patronymic']),
                'sirena_2019' => $this->search->searchSirena2019ByNameDob($surname, $post['firstname'], $post['patronymic'], $post['DOB'] ?? null),
                'tomsk_bank_clients_kronos_2013' => $this->search->searchTomskBankByNameDob($surname, $post['firstname'], $post['patronymic']),
                'unknown_10k' => $this->search->searchUnknown10kByNameDob($surname, $post['firstname'], $post['patronymic']),
                'covid19_move' => $this->search->searchCovid19MoveByName($surname, $post['firstname'], $post['patronymic']),
                'manual_inserted' => $this->search->searchManualInsertedByNameDob($surname, $post['firstname'], $post['patronymic']),
                'puma21' => $this->search->searchPuma21ByNameDob($surname, $post['firstname'], $post['patronymic']),
                'sportmaster' => $this->search->searchSportmasterByNameDob($surname, $post['firstname'], $post['patronymic']),
                'gemotest' => $this->search->searchGemotestByNameDob($surname, $post['firstname'], $post['patronymic']),
            ];
        } elseif (isset($post['firstname']) && isset($post['DOB'])) {
            $results = [
                'esia' => $this->search->searchEsiaByNameDob($surname, $post['firstname'], null, $post['DOB']),
                'rosreestr_owners' => $this->search->searchRosreestrOwnersByNameDob($surname, $post['firstname'], null, $post['DOB']),
                'sirena_2019' => $this->search->searchSirena2019ByNameDob($surname, $post['firstname'], null, $post['DOB']),
                'tomsk_bank_clients_kronos_2013' => $this->search->searchTomskBankByNameDob($surname, $post['firstname'], null, $post['DOB']),
                'unknown_10k' => $this->search->searchUnknown10kByNameDob($surname, $post['firstname'], null, $post['DOB']),
                'covid19_move' => $this->search->searchCovid19MoveByName($surname, $post['firstname']),
                'manual_inserted' => $this->search->searchManualInsertedByNameDob($surname, $post['firstname'], null, $post['DOB']),
                'puma21' => $this->search->searchPuma21ByNameDob($surname, $post['firstname'], null, $post['DOB']),
                'sportmaster' => $this->search->searchSportmasterByNameDob($surname, $post['firstname'], null, $post['DOB']),
                'gemotest' => $this->search->searchGemotestByNameDob($surname, $post['firstname'], null, $post['DOB']),
            ];
        } elseif (isset($post['firstname'])) {
            $results = [
                'esia' => $this->search->searchEsiaByNameDob($surname, $post['firstname']),
                'rosreestr_owners' => $this->search->searchRosreestrOwnersByNameDob($surname, $post['firstname']),
                'sirena_2019' => $this->search->searchSirena2019ByNameDob($surname, $post['firstname']),
                'tomsk_bank_clients_kronos_2013' => $this->search->searchTomskBankByNameDob($surname, $post['firstname']),
                'unknown_10k' => $this->search->searchUnknown10kByNameDob($surname, $post['firstname']),
                'covid19_move' => $this->search->searchCovid19MoveByName($surname, $post['firstname']),
                'manual_inserted' => $this->search->searchManualInsertedByNameDob($surname, $post['firstname']),
                'puma21' => $this->search->searchPuma21ByNameDob($surname, $post['firstname']),
                'sportmaster' => $this->search->searchSportmasterByNameDob($surname, $post['firstname']),
                'gemotest' => $this->search->searchGemotestByNameDob($surname, $post['firstname']),
            ];
        }

        return [
            'results' => $results,
            'sourceCount' => 10,
        ];
    }

    /**
     * @param array<string, mixed> $post
     * @return array{results: array<string, array<int, array<string, mixed>>>, sourceCount: int}
     */
    private function searchByPhone(array $post): array
    {
        $phone = (string) $post['phone'];
        $normalized = $phone;
        if ($phone !== '' && $phone[0] === '+') {
            $normalized = substr($phone, 1);
        }

        return [
            'results' => [
                'esia' => $this->search->searchEsiaByPhone($normalized),
                'covid19_move' => $this->search->searchCovid19MoveByPhone($normalized),
                'puma21' => $this->search->searchPuma21ByPhone($normalized),
                'getcontact' => $this->search->searchGetcontactByPhone($normalized),
                'sportmaster' => $this->search->searchSportmasterByPhone($normalized),
                'gemotest' => $this->search->searchGemotestByPhone($normalized),
                'unknown_10k' => $this->search->searchUnknown10kByPhone($normalized),
                'manual_inserted' => $this->search->searchManualInsertedByPhone($normalized),
            ],
            'sourceCount' => 8,
        ];
    }

    /**
     * @param array<string, mixed> $post
     * @return array{results: array<string, array<int, array<string, mixed>>>, sourceCount: int}
     */
    private function searchByEmail(array $post): array
    {
        $email = (string) $post['email'];

        return [
            'results' => [
                'esia' => $this->search->searchEsiaByEmail($email),
                'covid19_move' => $this->search->searchCovid19MoveByEmail($email),
                'puma21' => $this->search->searchPuma21ByEmail($email),
                'unknown_10k' => $this->search->searchUnknown10kByEmail($email),
                'manual_inserted' => $this->search->searchManualInsertedByEmail($email),
                'sportmaster' => $this->search->searchSportmasterByEmail($email),
            ],
            'sourceCount' => 6,
        ];
    }
}
