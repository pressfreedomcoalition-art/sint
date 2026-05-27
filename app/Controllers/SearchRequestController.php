<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Application;
use App\Search\SearchCriteria;

final class SearchRequestController
{
    private Application $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function handle(): void
    {
        global $user;

        $criteria = SearchCriteria::fromPost($_POST);
        if (
            $criteria->hasSurnameSearch()
            || $criteria->hasPhoneSearch()
            || $criteria->hasEmailSearch()
        ) {
            $this->app->searchOrchestrator()->executeAndPersist($criteria, (int) $user['id']);
        }
    }
}
