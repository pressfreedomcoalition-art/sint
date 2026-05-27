<?php

declare(strict_types=1);

namespace App\Services;

final class SearchOrchestratorResult
{
    /** @var bool Whether INSERT into search_requests should run */
    public bool $shouldPersist;

    public string $requestLabel;

    /** @var array<string, mixed>|null Payload for JSON result column */
    public ?array $resultPayload;

    public function __construct(
        bool $shouldPersist,
        string $requestLabel = '',
        ?array $resultPayload = null
    ) {
        $this->shouldPersist = $shouldPersist;
        $this->requestLabel = $requestLabel;
        $this->resultPayload = $resultPayload;
    }
}
