<?php
/** @var string $title */
/** @var string $content */
/** @var string $footerScriptsHtml */
/** @var string $bodyClass */
/** @var string $pageHeaderTitle */
/** @var string $pageHeaderIcon */
$bodyClass = $bodyClass ?? 'nav-fixed';
$pageHeaderIcon = $pageHeaderIcon ?? 'user-plus';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></title>
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
        <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="<?= htmlspecialchars($bodyClass, ENT_QUOTES, 'UTF-8') ?>">
        <div id="layoutSidenav">
            <div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                        <div class="container-xl px-4">
                            <div class="page-header-content">
                                <div class="row align-items-center justify-content-between pt-3">
                                    <div class="col-auto mb-3">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="<?= htmlspecialchars($pageHeaderIcon, ENT_QUOTES, 'UTF-8') ?>"></i></div>
                                            <?= htmlspecialchars($pageHeaderTitle, ENT_QUOTES, 'UTF-8') ?>
                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <?= $content ?>
                </main>
                <footer class="footer-admin mt-auto footer-light">
                    <div class="container-xl px-4">
                        <div class="row">
                            <div class="col-md-6 small"></div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <?php if (!empty($includeJquery)): ?>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <?php endif; ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <?= $footerScriptsHtml ?? '' ?>
    </body>
</html>
