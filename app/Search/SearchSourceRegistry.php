<?php

declare(strict_types=1);

namespace App\Search;

/**
 * Registry of data sources (stage 4). Orchestrators can iterate registered searchers.
 */
final class SearchSourceRegistry
{
    /** @var array<string, SourceSearcherInterface> */
    private array $searchers = [];

    public function register(SourceSearcherInterface $searcher): void
    {
        $this->searchers[$searcher->getKey()] = $searcher;
    }

    /**
     * @return array<string, SourceSearcherInterface>
     */
    public function all(): array
    {
        return $this->searchers;
    }

    public function get(string $key): ?SourceSearcherInterface
    {
        return $this->searchers[$key] ?? null;
    }

    public static function createDefault(): self
    {
        $registry = new self();

        $registry->register(new LegacyCallableSourceSearcher(
            'esia',
            static fn ($s, $n = null, $p = null, $d = null) => search_esia_by_name_dob($s, $n, $p, $d),
            static fn ($ph) => search_esia_by_phone($ph),
            static fn ($em) => search_esia_by_email($em)
        ));
        $registry->register(new LegacyCallableSourceSearcher(
            'rosreestr_owners',
            static fn ($s, $n = null, $p = null, $d = null) => search_rosreestr_owners_by_name_dob($s, $n, $p, $d)
        ));
        $registry->register(new LegacyCallableSourceSearcher(
            'sirena_2019',
            static fn ($s, $n = null, $p = null, $d = null) => search_sirena_2019_by_name_dob($s, $n, $p, $d)
        ));
        $registry->register(new LegacyCallableSourceSearcher(
            'tomsk_bank_clients_kronos_2013',
            static fn ($s, $n = null, $p = null, $d = null) => search_tomsk_bank_clients_kronos_2013_by_name_dob($s, $n, $p, $d)
        ));
        $registry->register(new LegacyCallableSourceSearcher(
            'unknown_10k',
            static fn ($s, $n = null, $p = null, $d = null) => search_unknown_10k_by_name_dob($s, $n, $p, $d),
            static fn ($ph) => search_unknown_10k_by_phone($ph),
            static fn ($em) => search_unknown_10k_by_email($em)
        ));
        $registry->register(new LegacyCallableSourceSearcher(
            'covid19_move',
            static fn ($s, $n = null, $p = null, $d = null) => search_covid19_move_by_name($s, $n, $p),
            static fn ($ph) => search_covid19_move_by_phone($ph),
            static fn ($em) => search_covid19_move_by_email($em)
        ));
        $registry->register(new LegacyCallableSourceSearcher(
            'manual_inserted',
            static fn ($s, $n = null, $p = null, $d = null) => search_manual_inserted_by_name_dob($s, $n, $p, $d),
            static fn ($ph) => search_manual_inserted_by_phone($ph),
            static fn ($em) => search_manual_inserted_by_email($em)
        ));
        $registry->register(new LegacyCallableSourceSearcher(
            'puma21',
            static fn ($s, $n = null, $p = null, $d = null) => search_puma21_by_name_dob($s, $n, $p, $d),
            static fn ($ph) => search_puma21_by_phone($ph),
            static fn ($em) => search_puma21_by_email($em)
        ));
        $registry->register(new LegacyCallableSourceSearcher(
            'sportmaster',
            static fn ($s, $n = null, $p = null, $d = null) => search_sportmaster_by_name_dob($s, $n, $p, $d),
            static fn ($ph) => search_sportmaster_by_phone($ph),
            static fn ($em) => search_sportmaster_by_email($em)
        ));
        $registry->register(new LegacyCallableSourceSearcher(
            'gemotest',
            static fn ($s, $n = null, $p = null, $d = null) => search_gemotest_by_name_dob($s, $n, $p, $d),
            static fn ($ph) => search_gemotest_by_phone($ph),
            static fn ($em) => search_gemotest_by_email($em)
        ));
        $registry->register(new LegacyCallableSourceSearcher(
            'getcontact',
            static fn ($s, $n = null, $p = null, $d = null) => [],
            static fn ($ph) => search_getcontact_by_phone($ph)
        ));

        return $registry;
    }
}
