<?php
include("config.php");
include("auth.php");
include("search_functions.php");
$results=null;
$x=0;
$msg_about_update=null;

?>


<?php
$statement = $pdo->prepare("SELECT * FROM search_requests WHERE id=?");  
$statement->execute(array($_GET["result"]));
$r=$statement->fetch(PDO::FETCH_ASSOC);
if(isset($_GET["result"]))
      {    
  if(!empty($_POST["hash"]))
  {

$statement = $pdo->prepare("SELECT * FROM faggots WHERE hash=?");  
$statement->execute(array($_POST["hash"]));
$f=$statement->fetch(PDO::FETCH_ASSOC); 
if($f==false)
{
    
$sql="INSERT INTO faggots (fio, dob, data, tags, comments,hash) VALUES (?,?,?,?,?,?)";
$statement = $pdo->prepare($sql);
$statement->execute(array($_POST["fio"],$_POST["dob"],$r["result"],$_POST["tags"],$_POST["comments"],$_POST["hash"]));
}
else
{
 $sql="UPDATE faggots SET data=?, tags=?, comments=? WHERE hash=?";
$statement = $pdo->prepare($sql);
$statement->execute(array($r["result"],$_POST["tags"],$_POST["comments"],$_POST["hash"]));  
}
$msg_about_update="Личное дело обновлено";
  }
  
    if(!empty($_POST["tags"]))
    {
$sql="UPDATE search_requests SET tags=? WHERE id=?";
$statement = $pdo->prepare($sql);
$statement->execute(array($_POST["tags"],$_GET["result"]));
    }
    

$results=json_decode($r["result"],true);
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
                                            Результаты запроса <?=$_GET["result"]; ?>
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
                                    <div class="card-header">Результаты запроса <?=$r["request"]; ?></div>
                                    <div class="card-body">
                                   <?php 
$j=0;
if(!isset($results["nothing_found"])){
    foreach($results as $base => $v)
    {
        if(count($v)>0)
        {
           
            echo $base."\r\n <br /> <br /> ";
             foreach($v as $d)
            {
                 foreach($d as $v)
                 {
                     if(!empty($v))
            echo $v." <br />";
                 }
                 echo " <br />";
            }
        }
   
    }
}
else
{
    echo "Ничего не найдено";
}
  
    
                                   ?>
                                    </div>
                                </div>
                                 <div class="card mb-8">
                                    <div class="card-header">Добавленные теги</div>
                                    <div class="card-body">
                                       
                                            <div class="row gx-3 mb-3">
                                                
                                                <div class="col-md-6">
                                                  
                                                   <br />
                                                    <?php 
                                                    if(!empty($r["tags"])){
                                                    echo $r["tags"];}
                                                    else {echo "теги ещё не добавлены"; }
                                                    
                                                    ?>
                                                    <br />
                                                </div>
                                               
                                               
                                            </div>
                                           
                                    
                                        
                                            
                                      
                                    </div>
                                </div>
                                <?php
                                $exp=explode(' ', $r["request"]);
                                if(count($exp)==4){
                                    $fio=$exp[0]." ".$exp[1]." ".$exp[2];
                                    $dob=$exp[3];
                                ?>
                                <div class="card mb-8">
                                    <div class="card-header">Создать/обновить личное дело</div>
                                    <div class="card-body">
                                        <form method="post" action="<?=BASE_URL; ?>/search_results.php?token=<?php echo $user["token"];  ?>&result=<?php echo $_GET["result"]; ?>">
                                            
                                     <input name="fio" type="text" value="<?=$fio;?>" hidden />
                                      <input name="dob" type="text" value="<?=$dob;?>" hidden />
                                    
                                            <div class="row gx-3 mb-3">
                                                
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="tags">Теги</label>
                                                    <input class="form-control" id="tags" name="tags" type="text" value="" placeholder="фсб,мвд" />
                                                </div>
                                               
                                              
                                            </div>
                                            <div class="row gx-3 mb-3">
                                                
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="tags">Комментарии</label>
                                                    <input class="form-control" id="tags" name="comments" type="text" value="" placeholder="" />
                                                </div>
                                               
                                               
                                            </div>
                                              <input name="hash" type="text" value="<?=md5($fio." ".$dob);?>" hidden />
                                            <button class="btn btn-primary" type="submit">Создать/изменить личное дело</button>
                                             <div class="row gx-3 mb-3">
                                              
                                               <?php
                                                if(isset($msg_about_update))
                                                {
                                                    echo $msg_about_update;
                                                }
                                               ?>
                                               
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="card mb-8">
                                    <div class="card-header">Добавить/обновить теги(через запятую)</div>
                                    <div class="card-body">
                                        <form method="post" action="<?=BASE_URL; ?>/search_results.php?token=<?php echo $user["token"];  ?>&result=<?php echo $_GET["result"]; ?>">
                                            <!-- Form Row-->
                                            <div class="row gx-3 mb-3">
                                                
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="tags">Теги</label>
                                                    <input class="form-control" id="tags" name="tags" type="text" value="" placeholder="фсб,мвд" />
                                                </div>
                                               
                                               
                                            </div>
                                           
                                    
                                            <button class="btn btn-primary" type="submit">Добавить теги</button>
                                            
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

<?php }
else
{

    $page=1;
    if(isset($_GET["page"]))
    {
        $page=$_GET["page"];
    }
    
                                     $statement = $pdo->prepare("SELECT COUNT(*) FROM search_requests");  
                                     $statement->execute();
                                     $c=$statement->fetch(PDO::FETCH_ASSOC);
                                     $maxpage=ceil($c["COUNT(*)"]/100);
                                     if($page>$maxpage)
{
$page=1;
}
$statement = $pdo->prepare("SELECT * FROM search_requests WHERE user_id=? AND id BETWEEN ? AND ? ORDER BY id DESC");  
$statement->execute(array($user["id"],($page-1)*100,$page*100));
$req=$statement->fetchAll(PDO::FETCH_ASSOC);
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
                                            Запросы на поиск
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
                                    <div class="card-header">Запросы</div>
                                    <div class="card-body">
                                        <?php 
                                        foreach($req as $r)
                                        {

                                        ?>
                                           <div class="row gx-3 mb-3">
                                             <?php echo $r["id"]."  ".$r["request"]  ?>
                                              <a href="<?=BASE_URL; ?>/search_results.php?token=<?php echo $user["token"];  ?>&result=<?php echo $r["id"]; ?>">Просмотреть результаты</a>
                                               
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
                                       <a class="page-link" href="search_results.php?token=<?php echo $user["token"];  ?>&page=1">1</a>
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
                                    <li class="page-item"><a class="page-link <?php if($page==$i) echo "active"; ?>" href="search_results.php?token=<?php echo $user["token"];  ?>&page=<?=$i; ?>"><?=$i; ?></a></li>
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
                                     
                                    <li class="page-item"><a class="page-link" href="search_results.php?token=<?php echo $user["token"];  ?>&page=<?=$maxpage; ?>"><?=$maxpage; ?></a></li>
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




    <?php
}


?>