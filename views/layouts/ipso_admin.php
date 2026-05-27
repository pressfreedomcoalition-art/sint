<?php
/** @var string $title */
/** @var string $content */
/** @var string $footerScriptsHtml */
/** @var bool $includeDatatables */
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></title>
        <?php if (!empty($includeDatatables)) { ?>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <?php } ?>
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
        <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="nav-fixed">
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sidenav shadow-right sidenav-light">
                    <div class="sidenav-menu">
                        <a class="nav-link" href="ipso.php">На главную</a>
                        <a class="nav-link" href="ipso_users_list.php">Юзеры</a>
                        <a class="nav-link" href="access_keys.php">Ключи доступа</a>
                        <a class="nav-link" href="criminal_organizations.php">Преступные организации</a>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                        <div class="container-xl px-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="user-plus"></i></div>
                                <?= htmlspecialchars($pageHeaderTitle, ENT_QUOTES, 'UTF-8') ?>
                            </h1>
                        </div>
                    </header>
                    <?= $content ?>
                </main>
                <footer class="footer-admin mt-auto footer-light">
                    <div class="container-xl px-4"><div class="col-md-6 small">Copyright &copy; 2026</div></div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <?php if (!empty($includeDatatables)) { ?>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables/datatables-simple-demo.js"></script>
        <?php } ?>
        <?= $footerScriptsHtml ?? '' ?>
    </body>
</html>
