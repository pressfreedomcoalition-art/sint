<?php
/** @var array<int, array<string, mixed>> $persons */
/** @var \App\Support\Pagination $pagination */
/** @var string $pageBaseUrl */
/** @var string $listMode */
/** @var string $searchQuery */
/** @var int $selectedOrgId */
/** @var array<int, array<string, mixed>> $organizationCatalog */
?>
<div class="container-xl px-4 mt-4">
    <?php if (($listMode ?? 'all') === 'pool' || ($listMode ?? 'all') === 'mine') { ?>
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-4">
                <div class="card-header">Поиск и фильтр</div>
                <div class="card-body">
                    <form method="get" class="row gx-3 gy-2">
                        <div class="col-md-5">
                            <label class="small mb-1" for="q">Поиск (ФИО / ДР / hash)</label>
                            <input class="form-control" id="q" name="q" type="text" value="<?= htmlspecialchars((string) ($searchQuery ?? ''), ENT_QUOTES, 'UTF-8') ?>" />
                        </div>
                        <div class="col-md-5">
                            <label class="small mb-1" for="org_id">Организация</label>
                            <select class="form-select" id="org_id" name="org_id">
                                <option value="">Все</option>
                                <?php foreach (($organizationCatalog ?? []) as $org) {
                                    $oid = (int) $org['id'];
                                    $selected = ((int) ($selectedOrgId ?? 0) === $oid) ? 'selected' : '';
                                    ?>
                                    <option value="<?= $oid ?>" <?= $selected ?>>
                                        <?= htmlspecialchars((string) $org['name'], ENT_QUOTES, 'UTF-8') ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end gap-2">
                            <button class="btn btn-primary" type="submit">Применить</button>
                            <?php if (($listMode ?? '') === 'pool') { ?>
                                <a class="btn btn-light" href="criminals_pool.php">Сброс</a>
                            <?php } else { ?>
                                <a class="btn btn-light" href="my_clients.php">Сброс</a>
                            <?php } ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-8">
                <div class="card-header">
                    <?php
                    if (($listMode ?? 'all') === 'pool') {
                        echo 'Нераспределенные преступники';
                    } elseif (($listMode ?? 'all') === 'mine') {
                        echo 'Мои клиенты';
                    } else {
                        echo 'Все записи';
                    }
                    ?>
                </div>
                <div class="card-body">
                    <?php foreach ($persons as $r) { ?>
                    <div class="row gx-3 mb-3">
                        <?= $r['fio'] . ' ' . $r['dob'] . ' ' . $r['organizations'] ?>
                        <?php if (!empty($r['is_criminal'])) { ?>
                            <span class="badge bg-danger ms-2">преступник</span>
                        <?php } ?>
                        <a href="<?= BASE_URL ?>/single_person.php?hash=<?= urlencode($r['hash']) ?>">Просмотреть данные персонажа</a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-8">
                <div class="card-body">
                    <?php require SINT_ROOT . '/views/partials/pagination.php'; ?>
                </div>
            </div>
        </div>
    </div>
</div>
