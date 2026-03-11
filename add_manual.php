<?php
include("config.php");
if(isset($_POST["surname"]) && isset($_POST["firstname"]) && isset($_POST["patronymic"]) && isset($_POST["DOB"]))
{
$emails="";
$phones="";
$addresses="";
$socialnetworks="";
$additional_info="";
$tags="";
if(isset($_POST["emails"]))
{
   $emails=$_POST["emails"]; 
}
if(isset($_POST["phones"]))
{
   $phones=$_POST["phones"]; 
}
if(isset($_POST["addresses"]))
{
   $addresses=$_POST["addresses"]; 
}
if(isset($_POST["socialnetworks"]))
{
   $socialnetworks=$_POST["socialnetworks"]; 
}
if(isset($_POST["additional_info"]))
{
   $additional_info=$_POST["additional_info"]; 
}
$tags="";
if(isset($_POST["tags"]))
{
   $tags=$_POST["tags"]; 
}
if(isset($_POST["fsb"]))
{
    $tags.="фсб,";
}
if(isset($_POST["fso"]))
{
    $tags.="фсо,";
}
if(isset($_POST["mvd"]))
{
    $tags.="мвд,";
}
if(isset($_POST["rosguard"]))
{
    $tags.="росгвардия,";
}
if(isset($_POST["army"]))
{
    $tags.="вс рф,";
}
$statement = $pdo->prepare("INSERT INTO manual_inserted (surname,firstname,patronymic,dob,emails,phones,addresses,socialnetworks,additional_info,tags) VALUES (?,?,?,?,?,?,?,?,?,?)");
$statement->execute(array($_POST["surname"],$_POST["firstname"],$_POST["patronymic"],$_POST["DOB"],$emails,$phones,$addresses,$socialnetworks,$additional_info,$tags));

}


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Add Manual</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
        <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="nav-fixed">
               <div id="layoutSidenav">
           
            <div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                        <div class="container-xl px-4">
                            <div class="page-header-content">
                                <div class="row align-items-center justify-content-between pt-3">
                                    <div class="col-auto mb-3">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="user-plus"></i></div>
                                            Добавить новую запись
                                        </h1>
                                    </div>
                                   <?php if(isset($_POST["surname"]) && isset($_POST["firstname"]) && isset($_POST["patronymic"]) && isset($_POST["DOB"]))
{?>
                                    <div class="col-auto mb-3">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"></div>
                                           Успешно добавлена новая запись
                                        </h1>
                                    </div>
                                  <?php  } ?>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-xl px-4 mt-4">
                        <div class="row">
                           
                            <div class="col-xl-8">
                                <!-- Account details card-->
                                <div class="card mb-4">
                                    <div class="card-header">Data</div>
                                    <div class="card-body">
                                        <form method="post">
                                            <!-- Form Row-->
                                            <div class="row gx-3 mb-3">
                                                <!-- Form Group (first name)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputSurName">Фамилия</label>
                                                    <input class="form-control" id="inputSurName" name="surname" type="text" value="" />
                                                </div>
                                                <!-- Form Group (last name)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputFirstName">Имя</label>
                                                    <input class="form-control" id="inputFirstName" name="firstname" type="text" value="" />
                                                </div>
                                            </div>
                                            <div class="row gx-3 mb-3">
                                                <!-- Form Group (first name)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputpatronymic">Отчество</label>
                                                    <input class="form-control" id="inputpatronymic" name="patronymic" type="text" value="" />
                                                </div>
                                                <!-- Form Group (last name)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputDOB">Дата рождения</label>
                                                    <input class="form-control" id="inputDOB" name="DOB" type="text" value="" />
                                                </div>
                                            </div>
                                            <!-- Form Group (email address)-->
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputEmailAddress">Emailы</label>
                                                <input class="form-control" id="inputEmailAddress" type="text" name="emails" value="" />
                                            </div>
                                             <div class="mb-3">
                                                <label class="small mb-1" for="inputPhone">Телефоны</label>
                                                <input class="form-control" id="inputPhone" type="text" name="phones" value="" />
                                            </div>
                                             <div class="mb-3">
                                                <label class="small mb-1" for="inputAddress">Адреса</label>
                                                <input class="form-control" id="inputAddress" type="text" name="addresses" value="" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputsocial">Соцсети</label>
                                                <input class="form-control" id="inputsocial" type="text" name="socialnetworks" value="" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputother">Другая информация</label>
                                                <input class="form-control" id="inputother" type="text" name="additional_info" value="" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputtags">Пометки, теги</label>
                                                <input class="form-control" id="inputtags" type="text" name="tags" value="" />
                                            </div>
                                           
                                            <div class="mb-3">
                                                <label class="small mb-1">Принадлежность к организациям</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" id="fsb" name="fsb" type="checkbox" value="" />
                                                    <label class="form-check-label" for="fsb">ФСБ</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" id="fso" name="fso" type="checkbox" value="" />
                                                    <label class="form-check-label" for="fso">ФСО</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" id="mvd" name="mvd" type="checkbox" value="" />
                                                    <label class="form-check-label" for="mvd">МВД</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" id="rosguard" name="rosguard" type="checkbox" value="" />
                                                    <label class="form-check-label" for="rosguard">Росгвардия</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" id="army" name="army" type="checkbox" value="" />
                                                    <label class="form-check-label" for="army">ВС РФ</label>
                                                </div>
                                            </div>
                                            <!-- Submit button-->
                                            <button class="btn btn-primary" type="submit">Добавить</button>
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
