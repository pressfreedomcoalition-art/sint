<?php
/** @var array<string, mixed> $person */
/** @var array<string, mixed> $sessionUser */
/** @var string $hash */
?>
<div id="layoutSidenav_nav">
    <nav class="sidenav shadow-right sidenav-light">
        <div class="sidenav-menu">
            <div class="nav accordion" id="accordionSidenav">
                <div class="row">
                    <div class="card mb-12">
                        <div class="card-header">Обновить личное дело</div>
                        <div class="card-body">
                            <form method="post" action="<?= BASE_URL ?>/single_person.php?hash=<?= urlencode($hash) ?>">
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-12">
                                        <label class="small mb-1" for="tags">Теги</label>
                                        <textarea class="form-control" id="tags" name="tags" rows="4" placeholder="тег1,тег2,тег3"><?php
                                        if (!empty($person['tags'])) {
                                            echo htmlspecialchars($person['tags'], ENT_QUOTES, 'UTF-8');
                                        }
                                        ?></textarea>
                                    </div>
                                </div>
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-12">
                                        <label class="small mb-1" for="comments">Комментарии</label>
                                        <textarea class="form-control" id="comments" name="comments" rows="8"></textarea>
                                    </div>
                                </div>
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-12">
                                        <label class="small mb-1" for="organizations">Принадлежность к организациям</label>
                                        <textarea class="form-control" id="organizations" name="organizatons" rows="4" placeholder="фсб,мвд,гру"><?php
                                        if (!empty($person['organizations'])) {
                                            echo htmlspecialchars($person['organizations'], ENT_QUOTES, 'UTF-8');
                                        }
                                        ?></textarea>
                                    </div>
                                </div>
                                <button class="btn btn-primary" name="upd" type="submit">Обновить</button>
                            </form>
                        </div>
                    </div>
                    <?php if ($person['user_id'] === null) { ?>
                    <div class="card mb-12">
                        <div class="card-header">Взять в работу</div>
                        <div class="card-body">
                            <form method="post" action="<?= BASE_URL ?>/single_person.php?hash=<?= urlencode($hash) ?>">
                                <input name="user_id" type="hidden" value="<?= (int) $sessionUser['id'] ?>" />
                                <button class="btn btn-primary" name="take" type="submit">Взять в работу</button>
                            </form>
                        </div>
                    </div>
                    <?php } elseif ((int) $sessionUser['id'] === (int) $person['user_id']) { ?>
                    <div class="card mb-12">
                        <div class="card-header">Отказаться</div>
                        <div class="card-body">
                            <form method="post" action="<?= BASE_URL ?>/single_person.php?hash=<?= urlencode($hash) ?>">
                                <input name="user_id" type="hidden" value="<?= (int) $sessionUser['id'] ?>" />
                                <button class="btn btn-primary" name="refuse" type="submit">Отказаться</button>
                            </form>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>
</div>
