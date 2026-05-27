<?php
/** @var array<int, array<string, mixed>> $organizations */
?>
<div class="container-xl px-4 mt-4">
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-4">
                <div class="card-header">Добавить организацию</div>
                <div class="card-body">
                    <form method="post" class="d-flex gap-2">
                        <input class="form-control" type="text" name="name" placeholder="Organization name (EN)" required />
                        <button class="btn btn-primary" type="submit" name="create_org" value="1">Добавить</button>
                    </form>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">Список организаций</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Обновить</th>
                                    <th>Удалить</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($organizations as $org) { ?>
                                    <tr>
                                        <td><?= (int) $org['id'] ?></td>
                                        <td>
                                            <form method="post" class="d-flex gap-2">
                                                <input type="hidden" name="id" value="<?= (int) $org['id'] ?>" />
                                                <input class="form-control" type="text" name="name" value="<?= htmlspecialchars((string) $org['name'], ENT_QUOTES, 'UTF-8') ?>" required />
                                        </td>
                                        <td>
                                                <button class="btn btn-sm btn-primary" type="submit" name="update_org" value="1">Сохранить</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form method="post" onsubmit="return confirm('Delete organization?');">
                                                <input type="hidden" name="id" value="<?= (int) $org['id'] ?>" />
                                                <button class="btn btn-sm btn-danger" type="submit" name="delete_org" value="1">Удалить</button>
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

