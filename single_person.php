<?php
include("config.php");
include("auth.php");

if(!empty($_GET["hash"]) && !empty($_POST["user_id"]) && isset($_POST["take"]))
{
$sql="UPDATE faggots SET user_id=? WHERE hash=?";
$statement = $pdo->prepare($sql);
$statement->execute(array($_POST["user_id"],$_GET["hash"])); 
}
else if(!empty($_GET["hash"]) && !empty($_POST["user_id"]) && isset($_POST["refuse"]))
{
$sql="UPDATE faggots SET user_id=? WHERE hash=?";
$statement = $pdo->prepare($sql);
$statement->execute(array(null,$_GET["hash"])); 
}

if(isset($_POST["upd"]) && !empty($_GET["hash"]) && !empty($_POST["tags"]))
{
$sql="UPDATE faggots SET tags=? WHERE hash=?";
$statement = $pdo->prepare($sql);
$statement->execute(array($_POST["tags"],$_GET["hash"]));  
}
if(isset($_POST["upd"]) && !empty($_GET["hash"]) && !empty($_POST["organizations"]))
{
$sql="UPDATE faggots SET organizations=? WHERE hash=?";
$statement = $pdo->prepare($sql);
$statement->execute(array($_POST["organizations"],$_GET["hash"]));  
}
$data=null;
$statement = $pdo->prepare("SELECT * FROM faggots WHERE hash=?");  
$statement->execute(array($_GET["hash"]));
$r=$statement->fetch(PDO::FETCH_ASSOC);
if($r==false)
{
     header('location: ipso.php');
}
$data=json_decode($r["data"],true);

if(isset($_POST["upd"]) && !empty($_POST["comments"]))
{
$sql="INSERT INTO ipso_comments (comment, user, person_id, comment_date) VALUES (?,?,?,NOW())";
$statement = $pdo->prepare($sql);
$statement->execute(array($_POST["comments"],$_SESSION["ipso_user"]["login"],intval($r["id"])));
}
$comments=null;
$statement = $pdo->prepare("SELECT * FROM ipso_comments WHERE person_id=?");  
$statement->execute(array($r["id"]));
$comments=$statement->fetchAll(PDO::FETCH_ASSOC);
if(count($comments)<1)
{
    $comments=null;
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
        <title></title>
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
                        <div class="nav accordion" id="accordionSidenav">
                        <div class="row">
                          
                          <div class="card mb-12">
                                    <div class="card-header">Обновить личное дело</div>
                                    <div class="card-body">
                                        <form method="post" action="<?=BASE_URL; ?>/single_person.php?hash=<?php echo $_GET["hash"]; ?>">
                                            <!-- Form Row-->
                                            <div class="row gx-3 mb-3">
                                                
                                                <div class="col-md-12">
                                                    <label class="small mb-1" for="tags">Теги</label>
                                                  
                                                   <textarea class="form-control" id="tags" name="tags" rows="4" placeholder="тег1,тег2,тег3"><?php 
                                                    if(!empty($r["tags"])){ echo $r["tags"];}
                                                    
                                                    ?></textarea>
                                                    
                                                </div>
                                               
                                               
                                            </div>
                                            <div class="row gx-3 mb-3">
                                                
                                                <div class="col-md-12">
                                                    <label class="small mb-1" for="comments">Комментарии</label>
                                                   
                                                    <textarea class="form-control" id="comments" name="comments" rows="8"></textarea>
                                                </div>
                                               
                                               
                                            </div>
                                             <div class="row gx-3 mb-3">
                                                
                                                <div class="col-md-12">
                                                    <label class="small mb-1" for="organizations">Принадлежность к организациям</label>
                                                   
                                                     <textarea class="form-control" id="organizations" name="organizatons" rows="4" placeholder="фсб,мвд,гру"><?php 
                                                    if(!empty($r["organizations"])){ echo $r["organizations"];}
                                
                                                    
                                                    ?></textarea>
                                                    
                                                </div>
                                               
                                               
                                            </div>
                                    
                                            <button class="btn btn-primary" name="upd" type="submit">Обновить</button>
                                            
                                        </form>
                                    </div>
                                </div>

                                 <?php
                                if($r["user_id"]==null){
                               
                                ?>
                                <div class="card mb-12">
                                    <div class="card-header">Взять в работу</div>
                                    <div class="card-body">
                                        <form method="post" action="<?=BASE_URL; ?>/single_person.php?hash=<?php echo $_GET["hash"]; ?>">
                                            
                                
                                      <input name="user_id" type="text" value="<?=$_SESSION["ipso_user"]["id"];?>" hidden />
                                    

                                            <button class="btn btn-primary" name="take" type="submit">Взять в работу</button>
                                             <div class="row gx-3 mb-3">
                                              
                                             
                                               
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <?php }
                                else if($_SESSION["ipso_user"]["id"]==$r["user_id"])
                                {
                                ?>

                                  <div class="card mb-12">
                                    <div class="card-header">Отказаться</div>
                                    <div class="card-body">
                                        <form method="post" action="<?=BASE_URL; ?>/single_person.php?hash=<?php echo $_GET["hash"]; ?>">
                                            
                                
                                      <input name="user_id" type="text" value="<?=$_SESSION["ipso_user"]["id"];?>" hidden />
                                    

                                            <button class="btn btn-primary" name="refuse" type="submit">Отказаться</button>
                                             <div class="row gx-3 mb-3">
                                              
                                              
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <?php } ?>
                        
                        </div>
                        
            
                        </div>
                    </div>
                  
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                        <div class="container-xl px-4">
                            <div class="page-header-content">
                                <div class="row align-items-center justify-content-between pt-3">
                                    <div class="col-auto mb-3">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="user-plus"></i></div>
                                           Данные на  <?=$r["fio"]." ".$r["dob"]; ?>
                                        </h1>
                                    </div>
                                  <div class="col-12 col-xl-auto mb-3">
                                        <a class="btn btn-sm btn-light text-primary" href="ipso.php">
                                            <i class="me-1" data-feather="arrow-left"></i>
                                            Назад к списку целей
                                        </a>
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
                                                  <div class="card-header">Телефоны</div>
                                    <div class="card-body">
                                   <?php 

                                   if(!isset($data["nothing_found"])){
    foreach($data as $base => $v)
    {
                                    if(count($v)>0)
        {
           
            foreach($v as $d)
            {
                 foreach($d as $k => $l)
                 {
                     if(!empty($l) && ($k=="phone" || $k=="phones" || $k=="field25"))
                     {
                         echo $l." <br />";
                      
                     }
                   
                /*     if(!empty($l) && ($k=="address" || $k=="addresses"))
                     {
                         $output["additional_info"][]=$l;
                     }*/
                 }
            }
                                    }
    }
                                   }
  
    
                                   ?>
                                    </div>
                                </div>
                                </div>
                                  <div class="card mb-8">
                                    <div class="card-header">Теги, комментарии и пр</div>
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
                                            <div class="row gx-3 mb-3">
                                                
                                                <div class="col-md-6">
                                                  
                                                   <br />
                                                    <?php 
                                                    if(!empty($comments)){
                                                    foreach($comments as $c)
                                                    {
                                                        echo $c["comment"]."<br />";
                                                        echo "Оставил: ".$c["user"]." ".$c["comment_date"];
                                                        echo "<br /><br />";
                                                    }
                                                    
                                                    }
                                                    else {echo "комментарии ещё не добавлены"; }
                                                    
                                                    ?>
                                                    <br />
                                                </div>
                                               
                                               
                                            </div>
                                            <div class="row gx-3 mb-3">
                                                
                                                <div class="col-md-6">
                                                  
                                                   <br />
                                                    <?php 
                                                    if(!empty($r["organizations"])){
                                                    echo $r["organizations"];}
                                                    else {echo "организации ещё не добавлены"; }
                                                    
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
                                    foreach($data as $base => $v)
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