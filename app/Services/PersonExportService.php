<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\PersonRepository;
use App\Repositories\CriminalOrganizationRepository;

final class PersonExportService
{
    private PersonRepository $persons;
    private CriminalOrganizationRepository $organizations;

    public function __construct(
        PersonRepository $persons,
        CriminalOrganizationRepository $organizations
    )
    {
        $this->persons = $persons;
        $this->organizations = $organizations;
    }

    /**
     * @return array<string, mixed>|null
     */
    public function buildOutput(string $hash): ?array
    {
        $f = $this->persons->findByHash($hash);
        if ($f === false) {
            return null;
        }

        $output = [
            'id' => $f['id'],
            'full_name' => $f['fio'],
            'birth_date' => $f['dob'],
            'country' => null,
            'country_code' => null,
            'city' => null,
            'photo_url' => null,
            'identity_documents' => null,
            'additional_info' => !empty($f['comments']) ? $f['comments'] : null,
            'social_networks' => [],
            'phones' => [],
            'court_decisions' => [],
            'labels' => [],
            'debt_amount' => [
                ['currency' => 'USD', 'amount' => ''],
            ],
            'status' => null,
            'special_marks' => null,
            'criminal_organizations' => $this->organizations->findNamesByPersonId((int) $f['id']),
        ];

        $results = json_decode($f['data'], true);
        if (!is_array($results) || isset($results['nothing_found'])) {
            return $output;
        }

        foreach ($results as $base => $rows) {
            if (count($rows) < 1) {
                continue;
            }
            foreach ($rows as $d) {
                if ($base === 'sirena_2019') {
                    $output['identity_documents'] = $d['passport'] ?? null;
                }
                if ($base === 'esia') {
                    $output['identity_documents'] = $d['field17'] ?? null;
                }
                if ($base === 'covid19_move') {
                    $output['identity_documents'] = $d['passport'] ?? null;
                }
                foreach ($d as $k => $l) {
                    if (!empty($l) && ($k === 'phone' || $k === 'phones')) {
                        $output['phones'][] = $l;
                    }
                }
            }
        }

        return $output;
    }
}
