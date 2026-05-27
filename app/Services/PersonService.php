<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\IpsoCommentRepository;
use App\Repositories\PersonRepository;
use App\Support\Pagination;

final class PersonService
{
    private PersonRepository $persons;
    private IpsoCommentRepository $comments;

    public function __construct(PersonRepository $persons, IpsoCommentRepository $comments)
    {
        $this->persons = $persons;
        $this->comments = $comments;
    }

    /**
     * @return array{persons: array, pagination: Pagination}
     */
    public function listPaginated(int $page): array
    {
        $pagination = new Pagination($this->persons->countAll(), $page);
        [$from, $to] = $pagination->idRange();

        return [
            'persons' => $this->persons->findByIdRange($from, $to),
            'pagination' => $pagination,
        ];
    }

    /**
     * @param array<string, mixed> $get
     * @param array<string, mixed> $post
     * @param array<string, mixed> $sessionUser
     * @return array{person: array, data: array|null, comments: array|null}|null
     */
    public function handleDetail(string $hash, array $get, array $post, array $sessionUser): ?array
    {
        if (!empty($get['hash']) && !empty($post['user_id']) && isset($post['take'])) {
            $this->persons->assignUser((int) $post['user_id'], $get['hash']);
        } elseif (!empty($get['hash']) && !empty($post['user_id']) && isset($post['refuse'])) {
            $this->persons->unassign($get['hash']);
        }

        if (isset($post['upd']) && !empty($get['hash']) && !empty($post['tags'])) {
            $this->persons->updateTags($post['tags'], $get['hash']);
        }
        if (isset($post['upd']) && !empty($get['hash']) && !empty($post['organizations'])) {
            $this->persons->updateOrganizations($post['organizations'], $get['hash']);
        }

        $person = $this->persons->findByHash($hash);
        if ($person === false) {
            return null;
        }

        if (isset($post['upd']) && !empty($post['comments'])) {
            $this->comments->add($post['comments'], $sessionUser['login'], (int) $person['id']);
        }

        $commentRows = $this->comments->findByPersonId((int) $person['id']);

        return [
            'person' => $person,
            'data' => json_decode($person['data'], true),
            'comments' => count($commentRows) > 0 ? $commentRows : null,
            'sessionUser' => $sessionUser,
        ];
    }
}
