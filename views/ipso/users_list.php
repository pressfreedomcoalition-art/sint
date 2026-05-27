<?php
/** @var array<int, array<string, mixed>> $users */
/** @var bool $canDeleteUsers */
?>
<div class="container-fluid px-4">
    <div class="mb-3">
        <a class="btn btn-sm btn-light text-primary" href="access_keys.php">Управлять ключами доступа</a>
        <a class="btn btn-sm btn-light text-primary" href="criminal_organizations.php">Управлять преступными организациями</a>
    </div>
    <div class="card">
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $u) { ?>
                    <tr>
                        <td><?= $u['login'] ?></td>
                        <td><?= $u['role'] ?></td>
                        <td>
                            <?php if (!empty($canDeleteUsers)) { ?>
                                <a class="btn btn-datatable btn-transparent-dark" href="<?= BASE_URL ?>/ipso_users_list.php?action=delete&id=<?= (int) $u['id'] ?>">Удалить</a>
                            <?php } else { ?>
                                <span class="text-muted">Нет прав</span>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
