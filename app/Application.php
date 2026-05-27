<?php

declare(strict_types=1);

namespace App;

use App\Controllers\AddManualController;
use App\Controllers\AccessKeysController;
use App\Controllers\GetPersonController;
use App\Controllers\IpsoController;
use App\Controllers\CriminalPoolController;
use App\Controllers\CriminalOrganizationsController;
use App\Controllers\IpsoUsersController;
use App\Controllers\LoginController;
use App\Controllers\MyClientsController;
use App\Controllers\SearchController;
use App\Controllers\SearchResultsController;
use App\Controllers\SinglePersonController;
use App\Infrastructure\LegacySearchAdapter;
use App\Repositories\IpsoCommentRepository;
use App\Repositories\IpsoUserRepository;
use App\Repositories\AccessKeyRepository;
use App\Repositories\CriminalOrganizationRepository;
use App\Repositories\ManualInsertRepository;
use App\Repositories\PersonRepository;
use App\Repositories\SearchRequestRepository;
use App\Repositories\TokenUserRepository;
use App\Search\SearchSourceRegistry;
use App\Services\AuthGate;
use App\Services\ManualInsertService;
use App\Services\PersonExportService;
use App\Services\PersonService;
use App\Services\SearchOrchestrator;
use App\Services\SearchResultsService;
use App\Services\SyncSearchOrchestrator;
use PDO;

final class Application
{
    private static ?self $instance = null;

    /** @var PDO */
    private $pdo;

    private ?SearchSourceRegistry $searchRegistry = null;

    private function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public static function fromGlobals(): self
    {
        if (self::$instance === null) {
            global $pdo;
            if (!($pdo instanceof PDO)) {
                throw new \RuntimeException('PDO ($pdo) must be initialized in config.php');
            }
            self::$instance = new self($pdo);
        }

        return self::$instance;
    }

    public function pdo(): PDO
    {
        return $this->pdo;
    }

    public function searchRegistry(): SearchSourceRegistry
    {
        if ($this->searchRegistry === null) {
            $this->searchRegistry = SearchSourceRegistry::createDefault();
        }

        return $this->searchRegistry;
    }

    public function searchOrchestrator(): SearchOrchestrator
    {
        return new SearchOrchestrator(
            new LegacySearchAdapter(),
            new SearchRequestRepository($this->pdo)
        );
    }

    public function syncSearchOrchestrator(): SyncSearchOrchestrator
    {
        return new SyncSearchOrchestrator(new LegacySearchAdapter());
    }

    public function authGate(): AuthGate
    {
        return new AuthGate();
    }

    public function ipsoUsers(): IpsoUserRepository
    {
        return new IpsoUserRepository($this->pdo);
    }

    public function tokenUsers(): TokenUserRepository
    {
        return new TokenUserRepository($this->pdo);
    }

    public function accessKeys(): AccessKeyRepository
    {
        return new AccessKeyRepository($this->pdo);
    }

    public function criminalOrganizations(): CriminalOrganizationRepository
    {
        return new CriminalOrganizationRepository($this->pdo);
    }

    public function searchResultsService(): SearchResultsService
    {
        return new SearchResultsService(
            new SearchRequestRepository($this->pdo),
            new PersonRepository($this->pdo)
        );
    }

    public function personService(): PersonService
    {
        return new PersonService(
            new PersonRepository($this->pdo),
            new IpsoCommentRepository($this->pdo),
            new CriminalOrganizationRepository($this->pdo)
        );
    }

    public function personExportService(): PersonExportService
    {
        return new PersonExportService(
            new PersonRepository($this->pdo),
            new CriminalOrganizationRepository($this->pdo)
        );
    }

    public function manualInsertService(): ManualInsertService
    {
        return new ManualInsertService(new ManualInsertRepository($this->pdo));
    }

    public function searchRequestController(): \App\Controllers\SearchRequestController
    {
        return new \App\Controllers\SearchRequestController($this);
    }

    public function searchController(): SearchController
    {
        return new SearchController($this);
    }

    public function searchResultsController(): SearchResultsController
    {
        return new SearchResultsController($this);
    }

    public function ipsoController(): IpsoController
    {
        return new IpsoController($this);
    }

    public function singlePersonController(): SinglePersonController
    {
        return new SinglePersonController($this);
    }

    public function loginController(): LoginController
    {
        return new LoginController();
    }

    public function ipsoUsersController(): IpsoUsersController
    {
        return new IpsoUsersController($this);
    }

    public function accessKeysController(): AccessKeysController
    {
        return new AccessKeysController($this);
    }

    public function criminalOrganizationsController(): CriminalOrganizationsController
    {
        return new CriminalOrganizationsController($this);
    }

    public function addManualController(): AddManualController
    {
        return new AddManualController($this);
    }

    public function getPersonController(): GetPersonController
    {
        return new GetPersonController($this);
    }

    public function criminalPoolController(): CriminalPoolController
    {
        return new CriminalPoolController($this);
    }

    public function myClientsController(): MyClientsController
    {
        return new MyClientsController($this);
    }
}
