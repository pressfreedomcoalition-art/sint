<?php
/** @var \App\Support\Pagination $pagination */
/** @var string $pageBaseUrl ends with ? or & */
$page = $pagination->page;
$maxpage = $pagination->maxPage;
?>
<nav>
    <ul class="pagination justify-content-center">
        <li class="page-item <?php if ($page === 1) {
            echo 'active';
        } ?>">
            <a class="page-link" href="<?= htmlspecialchars($pageBaseUrl, ENT_QUOTES, 'UTF-8') ?>page=1">1</a>
        </li>
        <?php if ($page + 3 < $maxpage - 1) { ?>
        <li class="page-item disabled">
            <a class="page-link" href="#"><span>...</span></a>
        </li>
        <?php }
        for ($i = $page - 3; $i < $maxpage && $i < $page + 3; $i++) {
            if ($i > 1) { ?>
        <li class="page-item">
            <a class="page-link <?php if ($page === $i) {
                echo 'active';
            } ?>" href="<?= htmlspecialchars($pageBaseUrl, ENT_QUOTES, 'UTF-8') ?>page=<?= $i ?>"><?= $i ?></a>
        </li>
            <?php }
        }
        if ($page + 3 < $maxpage - 1) { ?>
        <li class="page-item disabled">
            <a class="page-link" href="#"><span>...</span></a>
        </li>
        <?php }
        if ($maxpage !== 1) { ?>
        <li class="page-item">
            <a class="page-link" href="<?= htmlspecialchars($pageBaseUrl, ENT_QUOTES, 'UTF-8') ?>page=<?= $maxpage ?>"><?= $maxpage ?></a>
        </li>
        <?php } ?>
    </ul>
</nav>
