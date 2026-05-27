<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\IpsoCommentRepository;
use App\Repositories\CriminalOrganizationRepository;
use App\Repositories\PersonRepository;
use App\Support\Pagination;

final class PersonService
{
    private PersonRepository $persons;
    private IpsoCommentRepository $comments;
    private CriminalOrganizationRepository $organizations;

    public function __construct(
        PersonRepository $persons,
        IpsoCommentRepository $comments,
        CriminalOrganizationRepository $organizations
    )
    {
        $this->persons = $persons;
        $this->comments = $comments;
        $this->organizations = $organizations;
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
     * @return array{persons: array, pagination: Pagination}
     */
    public function listCriminalUnassigned(int $page): array
    {
        $pagination = new Pagination($this->persons->countCriminalUnassigned(), $page);
        [$from, $to] = $pagination->idRange();

        return [
            'persons' => $this->persons->findCriminalUnassignedByIdRange($from, $to),
            'pagination' => $pagination,
        ];
    }

    /**
     * @return array{persons: array, pagination: Pagination}
     */
    public function listMyClients(int $ipsoUserId, int $page): array
    {
        $pagination = new Pagination($this->persons->countCriminalByAssignee($ipsoUserId), $page);
        [$from, $to] = $pagination->idRange();

        return [
            'persons' => $this->persons->findCriminalByAssigneeIdRange($ipsoUserId, $from, $to),
            'pagination' => $pagination,
        ];
    }

    /**
     * @param array<string, mixed> $get
     * @param array<string, mixed> $post
     * @param array<string, mixed> $sessionUser
     * @return array{person: array, data: array|null, comments: array|null, organizationCatalog: array, selectedOrganizationIds: array}|null
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
        $organizations = $post['organizations'] ?? $post['organizatons'] ?? null;
        if (isset($post['upd']) && !empty($get['hash']) && !empty($organizations)) {
            $this->persons->updateOrganizations((string) $organizations, $get['hash']);
        }

        $person = $this->persons->findByHash($hash);
        if ($person === false) {
            return null;
        }

        $role = (string) ($sessionUser['role'] ?? '');
        if ($role === 'ipsoshnik') {
            $assignedId = (int) ($person['assigned_ipso_user_id'] ?? 0);
            $isCriminal = (int) ($person['is_criminal'] ?? 0) === 1;
            $isOwn = $assignedId === (int) $sessionUser['id'];
            $isUnassigned = $assignedId === 0;
            if (!$isCriminal || (!$isOwn && !$isUnassigned)) {
                return null;
            }
        }

        if (isset($post['upd']) && !empty($post['comments'])) {
            $this->comments->add($post['comments'], $sessionUser['login'], (int) $person['id']);
        }

        if (isset($post['upd'])) {
            $selected = [];
            if (!empty($post['org_ids']) && is_array($post['org_ids'])) {
                $selected = array_values(array_unique(array_map('intval', $post['org_ids'])));
            }
            $this->organizations->replacePersonOrganizations((int) $person['id'], $selected);
        }

        $commentRows = $this->comments->findByPersonId((int) $person['id']);

        return [
            'person' => $person,
            'data' => json_decode($person['data'], true),
            'comments' => count($commentRows) > 0 ? $commentRows : null,
            'sessionUser' => $sessionUser,
            'organizationCatalog' => $this->organizations->findAll(),
            'selectedOrganizationIds' => $this->organizations->findOrganizationIdsByPersonId((int) $person['id']),
        ];
    }
}
