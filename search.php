<?php
include("config.php");
include("auth.php");
include("search_functions.php");
$results=null;
$x=0;
if(isset($_POST["surname"]))
{
   
    $results=array();
    if(isset($_POST["firstname"]) && isset($_POST["patronymic"]) && isset($_POST["DOB"]))
    {
       $results["esia"] = search_esia_by_name_dob($_POST["surname"],$_POST["firstname"],$_POST["patronymic"],$_POST["DOB"]);
     $results["rosreestr_owners"] = search_rosreestr_owners_by_name_dob($_POST["surname"],$_POST["firstname"],$_POST["patronymic"],$_POST["DOB"]);
       $results["sirena_2019"] = search_sirena_2019_by_name_dob($_POST["surname"],$_POST["firstname"],$_POST["patronymic"],$_POST["DOB"]);
       $results["tomsk_bank_clients_kronos_2013"] = search_tomsk_bank_clients_kronos_2013_by_name_dob($_POST["surname"],$_POST["firstname"],$_POST["patronymic"],$_POST["DOB"]);
      $results["unknown_10k"] = search_unknown_10k_by_name_dob($_POST["surname"],$_POST["firstname"],$_POST["patronymic"],$_POST["DOB"]);
      $results["covid19_move"] = search_covid19_move_by_name($_POST["surname"],$_POST["firstname"],$_POST["patronymic"]);
       $results["manual_inserted"] = search_manual_inserted_by_name_dob($_POST["surname"],$_POST["firstname"],$_POST["patronymic"],$_POST["DOB"]);
      $results["puma21"] = search_puma21_by_name_dob($_POST["surname"],$_POST["firstname"],$_POST["patronymic"],$_POST["DOB"]);
      $results["sportmaster"] = search_sportmaster_by_name_dob($_POST["surname"],$_POST["firstname"],$_POST["patronymic"],$_POST["DOB"]);
      $results["gemotest"] = search_gemotest_by_name_dob($_POST["surname"],$_POST["firstname"],$_POST["patronymic"],$_POST["DOB"]);
    }
    else if(isset($_POST["firstname"]) && isset($_POST["patronymic"]))
    {
         $results["esia"] = search_esia_by_name_dob($_POST["surname"],$_POST["firstname"],$_POST["patronymic"]);
     $results["rosreestr_owners"] = search_rosreestr_owners_by_name_dob($_POST["surname"],$_POST["firstname"],$_POST["patronymic"]);
       $results["sirena_2019"] = search_sirena_2019_by_name_dob($_POST["surname"],$_POST["firstname"],$_POST["patronymic"],$_POST["DOB"]);
       $results["tomsk_bank_clients_kronos_2013"] = search_tomsk_bank_clients_kronos_2013_by_name_dob($_POST["surname"],$_POST["firstname"],$_POST["patronymic"]);
       $results["unknown_10k"] = search_unknown_10k_by_name_dob($_POST["surname"],$_POST["firstname"],$_POST["patronymic"]);
       $results["covid19_move"] = search_covid19_move_by_name($_POST["surname"],$_POST["firstname"],$_POST["patronymic"]);
       $results["manual_inserted"] = search_manual_inserted_by_name_dob($_POST["surname"],$_POST["firstname"],$_POST["patronymic"]);
       $results["puma21"] = search_puma21_by_name_dob($_POST["surname"],$_POST["firstname"],$_POST["patronymic"]);
       $results["sportmaster"] = search_sportmaster_by_name_dob($_POST["surname"],$_POST["firstname"],$_POST["patronymic"]);
       $results["gemotest"] = search_gemotest_by_name_dob($_POST["surname"],$_POST["firstname"],$_POST["patronymic"]);
    }
    else if(isset($_POST["firstname"]) && isset($_POST["DOB"]))
    {
         $results["esia"] = search_esia_by_name_dob($_POST["surname"],$_POST["firstname"],null,$_POST["DOB"]);
      $results["rosreestr_owners"] = search_rosreestr_owners_by_name_dob($_POST["surname"],$_POST["firstname"],null,$_POST["DOB"]);
       $results["sirena_2019"] = search_sirena_2019_by_name_dob($_POST["surname"],$_POST["firstname"],null,$_POST["DOB"]);
       $results["tomsk_bank_clients_kronos_2013"] = search_tomsk_bank_clients_kronos_2013_by_name_dob($_POST["surname"],$_POST["firstname"],null,$_POST["DOB"]);
       $results["unknown_10k"] = search_unknown_10k_by_name_dob($_POST["surname"],$_POST["firstname"],null,$_POST["DOB"]);
       $results["covid19_move"] = search_covid19_move_by_name($_POST["surname"],$_POST["firstname"]);
       $results["manual_inserted"] = search_manual_inserted_by_name_dob($_POST["surname"],$_POST["firstname"],null,$_POST["DOB"]);
       $results["puma21"] = search_puma21_by_name_dob($_POST["surname"],$_POST["firstname"],null,$_POST["DOB"]);
       $results["sportmaster"] = search_sportmaster_by_name_dob($_POST["surname"],$_POST["firstname"],null,$_POST["DOB"]);
       $results["gemotest"] = search_gemotest_by_name_dob($_POST["surname"],$_POST["firstname"],null,$_POST["DOB"]);
    }
    else if(isset($_POST["firstname"]))
    {
         $results["esia"] = search_esia_by_name_dob($_POST["surname"],$_POST["firstname"]);
      $results["rosreestr_owners"] = search_rosreestr_owners_by_name_dob($_POST["surname"],$_POST["firstname"]);
       $results["sirena_2019"] = search_sirena_2019_by_name_dob($_POST["surname"],$_POST["firstname"]);
       $results["tomsk_bank_clients_kronos_2013"] = search_tomsk_bank_clients_kronos_2013_by_name_dob($_POST["surname"],$_POST["firstname"]);
      $results["unknown_10k"] = search_unknown_10k_by_name_dob($_POST["surname"],$_POST["firstname"]);
       $results["covid19_move"] = search_covid19_move_by_name($_POST["surname"],$_POST["firstname"]);
       $results["manual_inserted"] = search_manual_inserted_by_name_dob($_POST["surname"],$_POST["firstname"]);
       $results["puma21"] = search_puma21_by_name_dob($_POST["surname"],$_POST["firstname"]);
       $results["sportmaster"] = search_sportmaster_by_name_dob($_POST["surname"],$_POST["firstname"]);
       $results["gemotest"] = search_gemotest_by_name_dob($_POST["surname"],$_POST["firstname"]);
    }
    $x=10;
   
}
if(isset($_POST["phone"]))
{
    $ph="";
    if($_POST["phone"][0]=='+'){
    $ph=substr($_POST["phone"], 1);
    }
    else
    {
        $ph=$_POST["phone"];
    }
    $results=array();
   $results["esia"] = search_esia_by_phone($ph);
   $results["covid19_move"] = search_covid19_move_by_phone($ph);
  $results["puma21"] = search_puma21_by_phone($ph);
    $results["getcontact"] = search_getcontact_by_phone($ph);
  $results["sportmaster"] = search_sportmaster_by_phone($ph);
   $results["gemotest"] = search_gemotest_by_phone($ph);
   $results["unknown_10k"] = search_unknown_10k_by_phone($ph);
   $results["manual_inserted"] = search_manual_inserted_by_phone($ph);

   $x=8;
}


if(isset($_POST["email"]))
{
    $results=array();
   $results["esia"] = search_esia_by_email($_POST["email"]);
   $results["covid19_move"] = search_covid19_move_by_email($_POST["email"]);
   $results["puma21"] = search_puma21_by_email($_POST["email"]);
    $results["unknown_10k"] = search_unknown_10k_by_email($_POST["email"]);
   $results["manual_inserted"] = search_manual_inserted_by_email($_POST["email"]);
    $results["sportmaster"] = search_sportmaster_by_email($_POST["email"]);

    $x=6;
}
?>

<?php if(!isset($_POST["surname"]) && !isset($_POST["phone"]) && !isset($_POST["email"])){ ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Поиск</title>
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
                                            Поиск
                                        </h1>
                                    </div>
                                 
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-xl px-4 mt-4">
                        <div class="row">
                           
                            <div class="col-xl-8">
                               
                                <div class="card mb-4">
                                    <div class="card-header">Поиск по ФИО + ДР</div>
                                    <div class="card-body">
                                        <form method="post" id="search_by_name">
                                            <!-- Form Row-->
                                            <div class="row gx-3 mb-3" style="display:none" id="message1">
                                                  <label class="small mb-1" >Идёт поиск, ожидайте. Можете закрыть вкладку результаты появятся по ссылке <a href="<?=BASE_URL; ?>/search_results.php?token=<?php echo $user["token"];  ?>"><?=BASE_URL; ?>/search_results.php?token=<?php echo $user["token"];  ?></a></label>
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
                                            <!-- Form Row-->
                                            <div class="row gx-3 mb-3" style="display:none" id="message2">
                                                  <label class="small mb-1" >Идёт поиск, ожидайте.  Можете закрыть вкладку результаты появятся по ссылке <a href="<?=BASE_URL; ?>/search_results.php?token=<?php echo $user["token"];  ?>"><?=BASE_URL; ?>/search_results.php?token=<?php echo $user["token"];  ?></a></label>
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
                                            <!-- Form Row-->
                                            <div class="row gx-3 mb-3" style="display:none" id="message3">
                                                  <label class="small mb-1" >Идёт поиск, ожидайте. Можете закрыть вкладку результаты появятся по ссылке <a href="<?=BASE_URL; ?>/search_results.php?token=<?php echo $user["token"];  ?>"><?=BASE_URL; ?>/search_results.php?token=<?php echo $user["token"];  ?></a></label>
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
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script>
            $('#search_by_name').submit(function(e) {
  e.preventDefault();
  $.ajax({
    type: $(this).attr('method'),
    url: '<?=BASE_URL; ?>/search_request.php?token=<?php echo $user["token"];  ?>',
    data: $(this).serialize(),
    async: true,
    dataType: "html",
      beforeSend: function (result) {

               $("#message1").show();;
    },
      success: function (result) {
        window.location.href = '<?=BASE_URL; ?>/search_results.php?token=<?php echo $user["token"];  ?>';
  
    }
  });
});
             $('#search_by_phone').submit(function(e) {
  e.preventDefault();
  $.ajax({
    type: $(this).attr('method'),
    url: '<?=BASE_URL; ?>/search_request.php?token=<?php echo $user["token"];  ?>',
    data: $(this).serialize(),
    async: true,
    dataType: "html",
     beforeSend: function(result){
               $("#message2").show();;
    },
      success: function (result) {
        window.location.href = '<?=BASE_URL; ?>/search_results.php?token=<?php echo $user["token"];  ?>';
  
    }
  });
});
             $('#search_by_email').submit(function(e) {
  e.preventDefault();
  $.ajax({
    type: $(this).attr('method'),
    url: '<?=BASE_URL; ?>/search_request.php?token=<?php echo $user["token"];  ?>',
    data: $(this).serialize(),
    async: true,
      dataType: "html",
      beforeSend: function (result) {

               $("#message3").show();;
    },
      success: function (result) {
        window.location.href = '<?=BASE_URL; ?>/search_results.php?token=<?php echo $user["token"];  ?>';
  
    }
  });
});
        </script>
    </body>
</html> 
<?php }
      else if(isset($results))
      {
          
      
      
      
      ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Results</title>
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
                                            Результаты
                                        </h1>
                                    </div>
                                 
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-xl px-4 mt-4">
                        <div class="row">
                           
                            <div class="col-xl-12">
                               
                                <div class="card mb-8">
                                    <div class="card-header">Результаты</div>
                                    <div class="card-body">
                                   <?php 
$j=0;
    foreach($results as $base => $v)
    {
        if(count($v)>0)
        {
           
            echo $base."\r\n <br /> <br /> ";
             foreach($v as $d)
            {
            echo implode(";", $d)."<br /> <br />";
            }
        }
        else
        {
            $j++;
        }
    }
    if($j==$x)
    {
       echo "Ничего не найдено"; 
    }
    
                                   ?>
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

<?php } ?>