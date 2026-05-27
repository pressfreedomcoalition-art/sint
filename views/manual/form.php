<?php /** @var bool $success */ ?>
<div class="container-xl px-4 mt-4">
    <?php if ($success) { ?>
    <div class="alert alert-success mb-4">Успешно добавлена новая запись</div>
    <?php } ?>
    <div class="row">
        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header">Data</div>
                <div class="card-body">
                    <form method="post">
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputSurName">Фамилия</label>
                                <input class="form-control" id="inputSurName" name="surname" type="text" />
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">Имя</label>
                                <input class="form-control" id="inputFirstName" name="firstname" type="text" />
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputpatronymic">Отчество</label>
                                <input class="form-control" id="inputpatronymic" name="patronymic" type="text" />
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputDOB">Дата рождения</label>
                                <input class="form-control" id="inputDOB" name="DOB" type="text" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Emailы</label>
                            <input class="form-control" id="inputEmailAddress" type="text" name="emails" />
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputPhone">Телефоны</label>
                            <input class="form-control" id="inputPhone" type="text" name="phones" />
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputAddress">Адреса</label>
                            <input class="form-control" id="inputAddress" type="text" name="addresses" />
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputsocial">Соцсети</label>
                            <input class="form-control" id="inputsocial" type="text" name="socialnetworks" />
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputother">Другая информация</label>
                            <input class="form-control" id="inputother" type="text" name="additional_info" />
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputtags">Пометки, теги</label>
                            <input class="form-control" id="inputtags" type="text" name="tags" />
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1">Принадлежность к организациям</label>
                            <div class="form-check">
                                <input class="form-check-input" id="fsb" name="fsb" type="checkbox" />
                                <label class="form-check-label" for="fsb">ФСБ</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" id="fso" name="fso" type="checkbox" />
                                <label class="form-check-label" for="fso">ФСО</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" id="mvd" name="mvd" type="checkbox" />
                                <label class="form-check-label" for="mvd">МВД</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" id="rosguard" name="rosguard" type="checkbox" />
                                <label class="form-check-label" for="rosguard">Росгвардия</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" id="army" name="army" type="checkbox" />
                                <label class="form-check-label" for="army">ВС РФ</label>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
