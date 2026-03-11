<?php
include("config.php");
include("auth.php");

$page=1;
    if(isset($_GET["page"]))
    {
        $page=$_GET["page"];
    }
    
                                     $statement = $pdo->prepare("SELECT COUNT(*) FROM faggots");  
                                     $statement->execute();
                                     $c=$statement->fetch(PDO::FETCH_ASSOC);
                                     $maxpage=ceil($c["COUNT(*)"]/100);
                                     if($page>$maxpage)
{
$page=1;
}
$statement = $pdo->prepare("SELECT * FROM faggots WHERE id BETWEEN ? AND ? ORDER BY id DESC");  
$statement->execute(array(($page-1)*100,$page*100));
$ff=$statement->fetchAll(PDO::FETCH_ASSOC);
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
                   <?php if($_SESSION["ipso_user"]["role"]=="admin")
{
                             ?>
            <div id="layoutSidenav_nav">
                <nav class="sidenav shadow-right sidenav-light">
                    <div class="sidenav-menu">
                        <div class="nav accordion" id="accordionSidenav">
                          
                            <a class="nav-link" href="ipso_users_list.php">
                               
                                Юзеры
                          
                            </a>
                        
            
                        </div>
                    </div>
                  
                </nav>
            </div>
<?php } ?>
            <div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                        <div class="container-xl px-4">
                            <div class="page-header-content">
                                <div class="row align-items-center justify-content-between pt-3">
                                    <div class="col-auto mb-3">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="user-plus"></i></div>
                                            Данные
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
                                    <div class="card-header">Все записи</div>
                                    <div class="card-body">
                                        <?php 
                                        foreach($ff as $r)
                                        {

                                        ?>
                                           <div class="row gx-3 mb-3">
                                             <?php echo $r["fio"]." ".$r["dob"]." ".$r["organizations"]  ?>
                                              <a href="<?=BASE_URL; ?>/single_person.php?hash=<?php echo $r["hash"]; ?>">Просмотреть данные персонажа</a>
                                               
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    </div>
                                </div>
                               
                           
                            </div>
                        </div>
                        <div class="row">
                           
                            <div class="col-xl-12">
                               
                                <div class="card mb-8">
                                    <div class="card-body">
                                            <nav>
                                 <ul class="pagination justify-content-center">
                                  

                                    <li class="page-item <?php if($page==1) echo "active"; ?>">
                                       <a class="page-link" href="ipso.php?page=1">1</a>
                                    </li>
                                     
                                     <?php if($page+3<$maxpage-1){

                                     ?>
                                     <li class="page-item disabled">
                                       <a class="page-link" href="#">
                                       <span>...</span>
                                       </a>
                                    </li>
                                     <?php } 
                                     for($i=$page-3;$i<$maxpage && $i<$page+3;$i++)
                                     {
                                     if($i>1){
                                     ?>
                                    <li class="page-item"><a class="page-link <?php if($page==$i) echo "active"; ?>" href="ipso.php?page=<?=$i; ?>"><?=$i; ?></a></li>
                                     <?php }}
                                     if($page+3<$maxpage-1){
                                     ?>
                                     <li class="page-item disabled">
                                       <a class="page-link" href="#">
                                       <span>...</span>
                                       </a>
                                    </li>
                                     <?php }
                                     if($maxpage!=1){
                                     ?>
                                     
                                    <li class="page-item"><a class="page-link" href="ipso.php?page=<?=$maxpage; ?>"><?=$maxpage; ?></a></li>
                                     <?php 
                                     }
                                     ?>
                                 </ul>
                              </nav>
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
