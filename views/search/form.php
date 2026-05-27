<?php
/** @var array<string, mixed> $user */
$resultsUrl = BASE_URL . '/search_results.php?token=' . urlencode((string) $user['token']);
$requestUrl = BASE_URL . '/search_request.php?token=' . urlencode((string) $user['token']);
?>
<div class="container-xl px-4 mt-4">
    <div class="row">
        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header">Поиск по ФИО + ДР</div>
                <div class="card-body">
                    <form method="post" id="search_by_name">
                        <div class="row gx-3 mb-3" style="display:none" id="message1">
                            <label class="small mb-1">Идёт поиск, ожидайте. Можете закрыть вкладку результаты появятся по ссылке <a href="<?= htmlspecialchars($resultsUrl, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($resultsUrl, ENT_QUOTES, 'UTF-8') ?></a></label>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputSurName">Фамилия</label>
                                <input class="form-control" id="inputSurName" name="surname" type="text" value="" required />
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">Имя</label>
                                <input class="form-control" id="inputFirstName" name="firstname" type="text" value="" required />
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputpatronymic">Отчество</label>
                                <input class="form-control" id="inputpatronymic" name="patronymic" type="text" value="" />
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputDOB">Дата рождения</label>
                                <input class="form-control" id="inputDOB" name="DOB" type="text" value="" placeholder="22.03.1900" />
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Искать</button>
                    </form>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">Поиск по номеру телефона</div>
                <div class="card-body">
                    <form method="post" id="search_by_phone">
                        <div class="row gx-3 mb-3" style="display:none" id="message2">
                            <label class="small mb-1">Идёт поиск, ожидайте.  Можете закрыть вкладку результаты появятся по ссылке <a href="<?= htmlspecialchars($resultsUrl, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($resultsUrl, ENT_QUOTES, 'UTF-8') ?></a></label>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="phone">Номер телефона</label>
                                <input class="form-control" id="phone" name="phone" type="text" value="" placeholder="+7099999999" />
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Искать</button>
                    </form>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">Поиск по email</div>
                <div class="card-body">
                    <form method="post" id="search_by_email">
                        <div class="row gx-3 mb-3" style="display:none" id="message3">
                            <label class="small mb-1">Идёт поиск, ожидайте. Можете закрыть вкладку результаты появятся по ссылке <a href="<?= htmlspecialchars($resultsUrl, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($resultsUrl, ENT_QUOTES, 'UTF-8') ?></a></label>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="mail">Email</label>
                                <input class="form-control" id="mail" name="email" type="text" value="" placeholder="example@mail.ru" />
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Искать</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
