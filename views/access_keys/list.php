<?php
/** @var array<int, array<string, mixed>> $keys */
/** @var array<int, string> $statusOptions */
?>
<div class="container-xl px-4 mt-4">
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-4">
                <div class="card-header">Создать новый ключ</div>
                <div class="card-body">
                    <form method="post">
                        <div class="row gx-3 mb-3">
                            <div class="col-md-4">
                                <label class="small mb-1" for="newStatus">Статус</label>
                                <select class="form-select" id="newStatus" name="access_status" required>
                                    <?php foreach ($statusOptions as $status) { ?>
                                        <option value="<?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?>">
                                            <?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit" name="create_key" value="1">Создать ключ</button>
                    </form>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">Список ключей</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ключ</th>
                                    <th>Статус</th>
                                    <th>Действие</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($keys as $key) { ?>
                                    <tr>
                                        <td><?= (int) $key['id'] ?></td>
                                        <td>
                                            <?= htmlspecialchars((string) $key['token'], ENT_QUOTES, 'UTF-8') ?><br />
                                            <small><?= BASE_URL; ?>/search.php?token=<?= htmlspecialchars((string) $key['token'], ENT_QUOTES, 'UTF-8') ?></small>
                                        </td>
                                        <td>
                                            <form method="post" class="d-flex gap-2">
                                                <input type="hidden" name="id" value="<?= (int) $key['id'] ?>" />
                                                <select class="form-select" name="access_status">
                                                    <?php
                                                    $current = (string) ($key['access_status'] ?? 'user');
                                                    foreach ($statusOptions as $status) {
                                                        $selected = $current === $status ? 'selected' : '';
                                                        ?>
                                                        <option value="<?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?>" <?= $selected ?>>
                                                            <?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                        </td>
                                        <td>
                                                <button class="btn btn-sm btn-primary" type="submit" name="update_status" value="1">
                                                    Сохранить
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

