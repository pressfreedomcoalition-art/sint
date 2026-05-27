<?php
/** @var array<int, array<string, mixed>> $users */
?>
<div class="container-fluid px-4">
    <div class="mb-3">
        <a class="btn btn-sm btn-light text-primary" href="access_keys.php">Управлять ключами доступа</a>
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
                            <a class="btn btn-datatable btn-transparent-dark" href="<?= BASE_URL ?>/ipso_users_list.php?action=delete&id=<?= (int) $u['id'] ?>">Удалить</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
