<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Application;
use App\View\View;

final class SearchController
{
    private Application $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function handle(): void
    {
        global $user;

        $syncOutcome = $this->app->syncSearchOrchestrator()->execute($_POST);

        if ($syncOutcome === null) {
            View::renderLayout('main', 'search/form', [
                'title' => 'Поиск',
                'pageHeaderTitle' => 'Поиск',
                'user' => $user,
                'includeJquery' => true,
                'footerScripts' => 'search/form_scripts',
            ]);

            return;
        }

        View::renderLayout('main', 'search/sync_results', [
            'title' => 'Results',
            'pageHeaderTitle' => 'Результаты',
            'results' => $syncOutcome['results'],
            'sourceCount' => $syncOutcome['sourceCount'],
        ]);
    }
}
