<?php
/** @var array<string, mixed> $user */
/** @var int $resultId */
/** @var array<string, mixed> $record */
/** @var array<string, mixed>|null $results */
/** @var string|null $msgAboutUpdate */
/** @var array{fio: string, dob: string, hash: string}|null $fioDobForm */
$actionUrl = BASE_URL . '/search_results.php?token=' . urlencode((string) $user['token']) . '&result=' . $resultId;
?>
<div class="container-xl px-4 mt-4">
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-8">
                <div class="card-header">Результаты запроса <?= $record['request'] ?? '' ?></div>
                <div class="card-body">
<?php
if (is_array($results) && !isset($results['nothing_found'])) {
    foreach ($results as $base => $rows) {
        if (count($rows) > 0) {
            echo $base . "\r\n <br /> <br /> ";
            foreach ($rows as $d) {
                foreach ($d as $v) {
                    if (!empty($v)) {
                        echo $v . ' <br />';
                    }
                }
                echo ' <br />';
            }
        }
    }
} else {
    echo 'Ничего не найдено';
}
?>
                </div>
            </div>
            <div class="card mb-8">
                <div class="card-header">Добавленные теги</div>
                <div class="card-body">
                    <br />
                    <?php
                    if (!empty($record['tags'])) {
                        echo $record['tags'];
                    } else {
                        echo 'теги ещё не добавлены';
                    }
                    ?>
                    <br />
                </div>
            </div>
            <?php if ($fioDobForm !== null) { ?>
            <div class="card mb-8">
                <div class="card-header">Создать/обновить личное дело</div>
                <div class="card-body">
                    <form method="post" action="<?= $actionUrl ?>">
                        <input name="fio" type="hidden" value="<?= htmlspecialchars($fioDobForm['fio'], ENT_QUOTES, 'UTF-8') ?>" />
                        <input name="dob" type="hidden" value="<?= htmlspecialchars($fioDobForm['dob'], ENT_QUOTES, 'UTF-8') ?>" />
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="tags">Теги</label>
                                <input class="form-control" id="tags" name="tags" type="text" placeholder="фсб,мвд" />
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="comments">Комментарии</label>
                                <input class="form-control" name="comments" type="text" />
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="mark_criminal">Отметка</label>
                                <div class="form-check">
                                    <input class="form-check-input" id="mark_criminal" name="mark_criminal" type="checkbox" value="1" checked />
                                    <label class="form-check-label" for="mark_criminal">преступник</label>
                                </div>
                            </div>
                        </div>
                        <input name="hash" type="hidden" value="<?= htmlspecialchars($fioDobForm['hash'], ENT_QUOTES, 'UTF-8') ?>" />
                        <button class="btn btn-primary" type="submit">Создать/изменить личное дело</button>
                        <?php if ($msgAboutUpdate !== null) {
                            echo $msgAboutUpdate;
                        } ?>
                    </form>
                </div>
            </div>
            <?php } ?>
            <div class="card mb-8">
                <div class="card-header">Добавить/обновить теги(через запятую)</div>
                <div class="card-body">
                    <form method="post" action="<?= $actionUrl ?>">
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="tags2">Теги</label>
                                <input class="form-control" id="tags2" name="tags" type="text" placeholder="фсб,мвд" />
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Добавить теги</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
