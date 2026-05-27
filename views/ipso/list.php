<?php
/** @var array<int, array<string, mixed>> $persons */
/** @var \App\Support\Pagination $pagination */
/** @var string $pageBaseUrl */
/** @var string $listMode */
?>
<div class="container-xl px-4 mt-4">
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
