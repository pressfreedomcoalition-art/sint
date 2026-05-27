<?php
/** @var array<string, mixed> $user */
/** @var array<int, array<string, mixed>> $requests */
/** @var \App\Support\Pagination $pagination */
/** @var string $pageBaseUrl */
?>
<div class="container-xl px-4 mt-4">
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-8">
                <div class="card-header">Запросы</div>
                <div class="card-body">
                    <?php foreach ($requests as $r) { ?>
                    <div class="row gx-3 mb-3">
                        <?= $r['id'] . '  ' . $r['request'] ?>
                        <a href="<?= BASE_URL ?>/search_results.php?token=<?= urlencode((string) $user['token']) ?>&result=<?= (int) $r['id'] ?>">Просмотреть результаты</a>
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
