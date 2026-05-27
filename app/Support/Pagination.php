<?php

declare(strict_types=1);

namespace App\Support;

final class Pagination
{
    public int $page;
    public int $maxPage;
    public int $perPage;

    public function __construct(int $totalCount, int $page, int $perPage = 100)
    {
        $this->perPage = $perPage;
        $this->maxPage = max(1, (int) ceil($totalCount / $perPage));
        $this->page = $page;
        if ($this->page > $this->maxPage) {
            $this->page = 1;
        }
    }

    public function idRange(): array
    {
        return [($this->page - 1) * $this->perPage, $this->page * $this->perPage];
    }
}
