<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Application;
use App\View\View;

final class SearchResultsController
{
    private Application $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function handle(): void
    {
        global $user;

        if (isset($_GET['result'])) {
            $detail = $this->app->searchResultsService()->handleDetail(
                (int) $_GET['result'],
                $_POST
            );
            View::renderLayout('main', 'search_results/detail', [
                'title' => 'Results',
                'pageHeaderTitle' => 'Результаты запроса ' . $_GET['result'],
                'user' => $user,
                'resultId' => (int) $_GET['result'],
                'record' => $detail['record'],
                'results' => $detail['results'],
                'msgAboutUpdate' => $detail['msgAboutUpdate'],
                'fioDobForm' => $detail['fioDobForm'],
            ]);

            return;
        }

        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $list = $this->app->searchResultsService()->listForUser((int) $user['id'], $page);

        View::renderLayout('main', 'search_results/list', [
            'title' => 'Results',
            'pageHeaderTitle' => 'Запросы на поиск',
            'user' => $user,
            'requests' => $list['requests'],
            'pagination' => $list['pagination'],
            'pageBaseUrl' => 'search_results.php?token=' . urlencode((string) $user['token']) . '&',
        ]);
    }
}
