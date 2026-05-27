<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\PersonRepository;
use App\Repositories\SearchRequestRepository;
use App\Support\Pagination;

final class SearchResultsService
{
    private SearchRequestRepository $searchRequests;
    private PersonRepository $persons;

    public function __construct(
        SearchRequestRepository $searchRequests,
        PersonRepository $persons
    ) {
        $this->searchRequests = $searchRequests;
        $this->persons = $persons;
    }

    /**
     * @return array{requests: array, pagination: Pagination}
     */
    public function listForUser(int $userId, int $page): array
    {
        $pagination = new Pagination($this->searchRequests->countAll(), $page);
        [$from, $to] = $pagination->idRange();

        return [
            'requests' => $this->searchRequests->findByUserIdRange($userId, $from, $to),
            'pagination' => $pagination,
        ];
    }

    /**
     * @param array<string, mixed> $post
     * @return array{record: array, results: array|null, msgAboutUpdate: string|null, fioDobForm: array|null}
     */
    public function handleDetail(int $resultId, array $post): array
    {
        $record = $this->searchRequests->findById($resultId);
        if ($record === false) {
            return ['record' => [], 'results' => null, 'msgAboutUpdate' => null, 'fioDobForm' => null];
        }

        $msgAboutUpdate = null;

        if (!empty($post['hash'])) {
            $existing = $this->persons->findByHash($post['hash']);
            if ($existing === false) {
                $this->persons->create(
                    $post['fio'],
                    $post['dob'],
                    $record['result'],
                    $post['tags'],
                    $post['comments'],
                    $post['hash']
                );
            } else {
                $this->persons->updateData(
                    $record['result'],
                    $post['tags'],
                    $post['comments'],
                    $post['hash']
                );
            }
            $msgAboutUpdate = 'Личное дело обновлено';
        }

        if (!empty($post['tags'])) {
            $this->searchRequests->updateTags($resultId, $post['tags']);
            $record = $this->searchRequests->findById($resultId);
        }

        $results = json_decode($record['result'], true);
        $fioDobForm = null;
        $exp = explode(' ', $record['request']);
        if (count($exp) === 4) {
            $fioDobForm = [
                'fio' => $exp[0] . ' ' . $exp[1] . ' ' . $exp[2],
                'dob' => $exp[3],
                'hash' => md5($exp[0] . ' ' . $exp[1] . ' ' . $exp[2] . ' ' . $exp[3]),
            ];
        }

        return [
            'record' => $record,
            'results' => $results,
            'msgAboutUpdate' => $msgAboutUpdate,
            'fioDobForm' => $fioDobForm,
        ];
    }
}
