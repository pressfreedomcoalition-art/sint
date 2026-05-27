<?php
/** @var array<string, mixed>|null $data */
/** @var array<string, mixed> $person */
/** @var array<int, array<string, mixed>>|null $comments */
/** @var array<int, array<string, mixed>> $organizationCatalog */
/** @var array<int, int> $selectedOrganizationIds */
?>
<div class="container-xl px-4 mt-4">
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-8">
                <div class="card-header">Телефоны</div>
                <div class="card-body">
<?php
if (is_array($data) && !isset($data['nothing_found'])) {
    foreach ($data as $base => $rows) {
        if (count($rows) > 0) {
            foreach ($rows as $d) {
                foreach ($d as $k => $l) {
                    if (!empty($l) && ($k === 'phone' || $k === 'phones' || $k === 'field25')) {
                        echo $l . ' <br />';
                    }
                }
            }
        }
    }
}
?>
                </div>
            </div>
            <div class="card mb-8">
                <div class="card-header">Теги, комментарии и пр</div>
                <div class="card-body">
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <br />
                            <?php
                            if (!empty($person['tags'])) {
                                echo $person['tags'];
                            } else {
                                echo 'теги ещё не добавлены';
                            }
                            ?>
                            <br />
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <br />
                            <?php
                            if (!empty($comments)) {
                                foreach ($comments as $c) {
                                    echo $c['comment'] . '<br />';
                                    echo 'Оставил: ' . $c['user'] . ' ' . $c['comment_date'];
                                    echo '<br /><br />';
                                }
                            } else {
                                echo 'комментарии ещё не добавлены';
                            }
                            ?>
                            <br />
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <br />
                            <?php
                            $names = [];
                            foreach ($organizationCatalog as $org) {
                                if (in_array((int) $org['id'], $selectedOrganizationIds, true)) {
                                    $names[] = (string) $org['name'];
                                }
                            }
                            if (!empty($names)) {
                                echo implode('<br />', $names);
                            } elseif (!empty($person['organizations'])) {
                                echo $person['organizations']; // legacy fallback
                            } else {
                                echo 'организации ещё не добавлены';
                            }
                            ?>
                            <br />
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-8">
                <div class="card-header">Записи из баз</div>
                <div class="card-body">
<?php
if (is_array($data)) {
    foreach ($data as $base => $rows) {
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
}
?>
                </div>
            </div>
        </div>
    </div>
</div>
