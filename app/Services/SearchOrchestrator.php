<?php

declare(strict_types=1);

namespace App\Services;

use App\Infrastructure\LegacySearchAdapter;
use App\Repositories\SearchRequestRepository;
use App\Search\SearchCriteria;
use Exception;

/**
 * Async search flow (legacy search_request.php). Do not change branch conditions without regression tests.
 */
final class SearchOrchestrator
{
    private LegacySearchAdapter $search;
    private SearchRequestRepository $searchRequests;

    public function __construct(
        LegacySearchAdapter $search,
        SearchRequestRepository $searchRequests
    ) {
        $this->search = $search;
        $this->searchRequests = $searchRequests;
    }

    public function executeAndPersist(SearchCriteria $criteria, int $userId): void
    {
        try {
            $outcome = $this->execute($criteria);
            if (!$outcome->shouldPersist || $outcome->resultPayload === null) {
                return;
            }
            $this->searchRequests->create($userId, $outcome->requestLabel, $outcome->resultPayload);
            file_put_contents('log.txt', 'success search');
        } catch (Exception $ex) {
            file_put_contents('log.txt', (string) $ex);
        }
    }

    public function execute(SearchCriteria $criteria): SearchOrchestratorResult
    {
        if ($criteria->hasSurnameSearch()) {
            return $this->executeBySurname($criteria);
        }
        if ($criteria->hasPhoneSearch()) {
            return $this->executeByPhone($criteria);
        }
        if ($criteria->hasEmailSearch()) {
            return $this->executeByEmail($criteria);
        }

        return new SearchOrchestratorResult(false);
    }

    private function executeBySurname(SearchCriteria $criteria): SearchOrchestratorResult
    {
        $surname = $criteria->surname;
        $results = null;
        $sourceCount = 0;
        $request = '';
        $error = '';

        if (
            $criteria->firstname !== null
            && $criteria->patronymic !== null
            && $criteria->dob !== null
        ) {
            $results = [
                'esia' => $this->search->searchEsiaByNameDob($surname, $criteria->firstname, $criteria->patronymic, $criteria->dob),
                'rosreestr_owners' => $this->search->searchRosreestrOwnersByNameDob($surname, $criteria->firstname, $criteria->patronymic, $criteria->dob),
                'sirena_2019' => $this->search->searchSirena2019ByNameDob($surname, $criteria->firstname, $criteria->patronymic, $criteria->dob),
                'tomsk_bank_clients_kronos_2013' => $this->search->searchTomskBankByNameDob($surname, $criteria->firstname, $criteria->patronymic, $criteria->dob),
                'unknown_10k' => $this->search->searchUnknown10kByNameDob($surname, $criteria->firstname, $criteria->patronymic, $criteria->dob),
                'manual_inserted' => $this->search->searchManualInsertedByNameDob($surname, $criteria->firstname, $criteria->patronymic, $criteria->dob),
                'puma21' => $this->search->searchPuma21ByNameDob($surname, $criteria->firstname, $criteria->patronymic, $criteria->dob),
                'sportmaster' => $this->search->searchSportmasterByNameDob($surname, $criteria->firstname, $criteria->patronymic, $criteria->dob),
                'gemotest' => $this->search->searchGemotestByNameDob($surname, $criteria->firstname, $criteria->patronymic, $criteria->dob),
            ];
            $request = $surname . ' ' . $criteria->firstname . ' ' . $criteria->patronymic . ' ' . $criteria->dob;
            $sourceCount = 9;
        } elseif ($criteria->firstname !== null && $criteria->patronymic !== null) {
            $results = [
                'esia' => $this->search->searchEsiaByNameDob($surname, $criteria->firstname, $criteria->patronymic),
                'rosreestr_owners' => $this->search->searchRosreestrOwnersByNameDob($surname, $criteria->firstname, $criteria->patronymic),
                'sirena_2019' => $this->search->searchSirena2019ByNameDob($surname, $criteria->firstname, $criteria->patronymic, $criteria->dob),
                'tomsk_bank_clients_kronos_2013' => $this->search->searchTomskBankByNameDob($surname, $criteria->firstname, $criteria->patronymic),
                'unknown_10k' => $this->search->searchUnknown10kByNameDob($surname, $criteria->firstname, $criteria->patronymic),
                'covid19_move' => $this->search->searchCovid19MoveByName($surname, $criteria->firstname, $criteria->patronymic),
                'manual_inserted' => $this->search->searchManualInsertedByNameDob($surname, $criteria->firstname, $criteria->patronymic),
                'puma21' => $this->search->searchPuma21ByNameDob($surname, $criteria->firstname, $criteria->patronymic),
                'sportmaster' => $this->search->searchSportmasterByNameDob($surname, $criteria->firstname, $criteria->patronymic),
                'gemotest' => $this->search->searchGemotestByNameDob($surname, $criteria->firstname, $criteria->patronymic),
            ];
            $request = $surname . ' ' . $criteria->firstname . ' ' . $criteria->patronymic;
            $sourceCount = 10;
        } elseif ($criteria->firstname !== null && $criteria->dob !== null) {
            $results = [
                'esia' => $this->search->searchEsiaByNameDob($surname, $criteria->firstname, null, $criteria->dob),
                'rosreestr_owners' => $this->search->searchRosreestrOwnersByNameDob($surname, $criteria->firstname, null, $criteria->dob),
                'sirena_2019' => $this->search->searchSirena2019ByNameDob($surname, $criteria->firstname, null, $criteria->dob),
                'tomsk_bank_clients_kronos_2013' => $this->search->searchTomskBankByNameDob($surname, $criteria->firstname, null, $criteria->dob),
                'unknown_10k' => $this->search->searchUnknown10kByNameDob($surname, $criteria->firstname, null, $criteria->dob),
                'manual_inserted' => $this->search->searchManualInsertedByNameDob($surname, $criteria->firstname, null, $criteria->dob),
                'puma21' => $this->search->searchPuma21ByNameDob($surname, $criteria->firstname, null, $criteria->dob),
                'sportmaster' => $this->search->searchSportmasterByNameDob($surname, $criteria->firstname, null, $criteria->dob),
                'gemotest' => $this->search->searchGemotestByNameDob($surname, $criteria->firstname, null, $criteria->dob),
            ];
            $request = $surname . ' ' . $criteria->firstname . ' ' . $criteria->dob;
            $sourceCount = 9;
        } elseif ($criteria->firstname !== null) {
            file_put_contents('log10.txt', 'failed search');
            $results = [
                'esia' => $this->search->searchEsiaByNameDob($surname, $criteria->firstname),
                'rosreestr_owners' => $this->search->searchRosreestrOwnersByNameDob($surname, $criteria->firstname),
                'sirena_2019' => $this->search->searchSirena2019ByNameDob($surname, $criteria->firstname),
                'tomsk_bank_clients_kronos_2013' => $this->search->searchTomskBankByNameDob($surname, $criteria->firstname),
                'unknown_10k' => $this->search->searchUnknown10kByNameDob($surname, $criteria->firstname),
                'covid19_move' => $this->search->searchCovid19MoveByName($surname, $criteria->firstname),
                'manual_inserted' => $this->search->searchManualInsertedByNameDob($surname, $criteria->firstname),
                'puma21' => $this->search->searchPuma21ByNameDob($surname, $criteria->firstname),
                'sportmaster' => $this->search->searchSportmasterByNameDob($surname, $criteria->firstname),
                'gemotest' => $this->search->searchGemotestByNameDob($surname, $criteria->firstname),
            ];
            $request = $surname . ' ' . $criteria->firstname;
            $sourceCount = 10;
        } else {
            $request = $surname;
            $error = 'Недостаточно данных для поиска. Введите хотя бы имя.';
        }

        if ($results === null) {
            if ($error !== '') {
                return new SearchOrchestratorResult(
                    false,
                    $request,
                    ['nothing_found' => $error]
                );
            }

            return new SearchOrchestratorResult(false);
        }

        return $this->finalize($results, $sourceCount, $request, $error);
    }

    private function executeByPhone(SearchCriteria $criteria): SearchOrchestratorResult
    {
        $phone = $criteria->phone;
        $normalized = $phone;
        if ($phone[0] === '+') {
            $normalized = substr($phone, 1);
        }

        $results = [
            'esia' => $this->search->searchEsiaByPhone($normalized),
            'covid19_move' => $this->search->searchCovid19MoveByPhone($normalized),
            'puma21' => $this->search->searchPuma21ByPhone($normalized),
            'getcontact' => $this->search->searchGetcontactByPhone($normalized),
            'sportmaster' => $this->search->searchSportmasterByPhone($normalized),
            'gemotest' => $this->search->searchGemotestByPhone($normalized),
            'unknown_10k' => $this->search->searchUnknown10kByPhone($normalized),
            'manual_inserted' => $this->search->searchManualInsertedByPhone($normalized),
        ];

        return $this->finalize($results, 8, $phone, '');
    }

    private function executeByEmail(SearchCriteria $criteria): SearchOrchestratorResult
    {
        $email = $criteria->email;
        $results = [
            'esia' => $this->search->searchEsiaByEmail($email),
            'covid19_move' => $this->search->searchCovid19MoveByEmail($email),
            'puma21' => $this->search->searchPuma21ByEmail($email),
            'unknown_10k' => $this->search->searchUnknown10kByEmail($email),
            'manual_inserted' => $this->search->searchManualInsertedByEmail($email),
            'sportmaster' => $this->search->searchSportmasterByEmail($email),
        ];

        return $this->finalize($results, 6, $email, '');
    }

    /**
     * @param array<string, array<int, array<string, mixed>>> $results
     */
    private function finalize(
        array $results,
        int $sourceCount,
        string $request,
        string $error
    ): SearchOrchestratorResult {
        $emptyCount = 0;
        $filtered = [];

        foreach ($results as $base => $rows) {
            if (count($rows) < 1) {
                $emptyCount++;
            } else {
                $filtered[$base] = $rows;
            }
        }

        if ($emptyCount === $sourceCount) {
            $filtered['nothing_found'] = 'Ничего не найдено';
        }
        if ($error !== '') {
            $filtered['nothing_found'] = $error;
        }

        return new SearchOrchestratorResult(true, $request, $filtered);
    }
}
