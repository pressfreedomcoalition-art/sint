<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\ManualInsertRepository;

final class ManualInsertService
{
    private ManualInsertRepository $repository;

    public function __construct(ManualInsertRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array<string, mixed> $post
     */
    public function handleSubmit(array $post): bool
    {
        if (
            !isset($post['surname'], $post['firstname'], $post['patronymic'], $post['DOB'])
        ) {
            return false;
        }

        $tags = $post['tags'] ?? '';
        if (isset($post['fsb'])) {
            $tags .= 'фсб,';
        }
        if (isset($post['fso'])) {
            $tags .= 'фсо,';
        }
        if (isset($post['mvd'])) {
            $tags .= 'мвд,';
        }
        if (isset($post['rosguard'])) {
            $tags .= 'росгвардия,';
        }
        if (isset($post['army'])) {
            $tags .= 'вс рф,';
        }

        $this->repository->insert(
            $post['surname'],
            $post['firstname'],
            $post['patronymic'],
            $post['DOB'],
            $post['emails'] ?? '',
            $post['phones'] ?? '',
            $post['addresses'] ?? '',
            $post['socialnetworks'] ?? '',
            $post['additional_info'] ?? '',
            $tags
        );

        return true;
    }
}
