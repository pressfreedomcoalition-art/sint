<?php
ob_start();
session_start();
$login_error=null;
if(empty($_GET["token"]))
{
    if(!empty($_POST["login"]) && !empty($_POST["password"]))
    {
$statement = $pdo->prepare("SELECT * FROM ipso WHERE login=? AND password=?");  
$statement->execute(array($_POST["login"],hash('sha256', hash('sha256', $_POST["password"]))));
$ipso_user=$statement->fetch(PDO::FETCH_ASSOC);
if($ipso_user==false)
{
     $login_error="Неверный логин или пароль";
}
else
{
 $_SESSION["ipso_user"] = $ipso_user;
 header("location: ipso.php");
 exit;
}
    }
    else if((empty($_GET["page"]) || $_GET["page"]!="login") && !isset($_SESSION["ipso_user"]))
    {
    die("PAGE NOT FOUND");
    }
}
else
{
$statement = $pdo->prepare("SELECT * FROM users WHERE token=?");  
$statement->execute(array($_GET["token"]));
$user=$statement->fetch(PDO::FETCH_ASSOC);
if(count($user)<1)
{
     die("PAGE NOT FOUND");
}
}
?>