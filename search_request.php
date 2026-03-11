<?php
include("config.php");
include("auth.php");
include("search_functions.php");
$results=null;
$x=0;
$request="";
$error="";
try{
if(!empty($_POST["surname"]))
{
   
    $results=array();
    if(!empty($_POST["firstname"]) && !empty($_POST["patronymic"]) && !empty($_POST["DOB"]))
    {
       
       $results["esia"] = search_esia_by_name_dob($_POST["surname"],$_POST["firstname"],$_POST["patronymic"],$_POST["DOB"]);
     $results["rosreestr_owners"] = search_rosreestr_owners_by_name_dob($_POST["surname"],$_POST["firstname"],$_POST["patronymic"],$_POST["DOB"]);
       $results["sirena_2019"] = search_sirena_2019_by_name_dob($_POST["surname"],$_POST["firstname"],$_POST["patronymic"],$_POST["DOB"]);
       $results["tomsk_bank_clients_kronos_2013"] = search_tomsk_bank_clients_kronos_2013_by_name_dob($_POST["surname"],$_POST["firstname"],$_POST["patronymic"],$_POST["DOB"]);

      $results["unknown_10k"] = search_unknown_10k_by_name_dob($_POST["surname"],$_POST["firstname"],$_POST["patronymic"],$_POST["DOB"]);
     // $results["covid19_move"] = search_covid19_move_by_name($_POST["surname"],$_POST["firstname"],$_POST["patronymic"]);
       $results["manual_inserted"] = search_manual_inserted_by_name_dob($_POST["surname"],$_POST["firstname"],$_POST["patronymic"],$_POST["DOB"]);
      $results["puma21"] = search_puma21_by_name_dob($_POST["surname"],$_POST["firstname"],$_POST["patronymic"],$_POST["DOB"]);
      $results["sportmaster"] = search_sportmaster_by_name_dob($_POST["surname"],$_POST["firstname"],$_POST["patronymic"],$_POST["DOB"]);
   
      $results["gemotest"] = search_gemotest_by_name_dob($_POST["surname"],$_POST["firstname"],$_POST["patronymic"],$_POST["DOB"]);

       $request=$_POST["surname"]." ".$_POST["firstname"]." ".$_POST["patronymic"]." ".$_POST["DOB"];
         $x=9;
    }
    else if(!empty($_POST["firstname"]) && !empty($_POST["patronymic"]))
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
       
        $request=$_POST["surname"]." ".$_POST["firstname"]." ".$_POST["patronymic"];
          $x=10;
    }
    else if(!empty($_POST["firstname"]) && !empty($_POST["DOB"]))
    {
         $results["esia"] = search_esia_by_name_dob($_POST["surname"],$_POST["firstname"],null,$_POST["DOB"]);
      $results["rosreestr_owners"] = search_rosreestr_owners_by_name_dob($_POST["surname"],$_POST["firstname"],null,$_POST["DOB"]);
       $results["sirena_2019"] = search_sirena_2019_by_name_dob($_POST["surname"],$_POST["firstname"],null,$_POST["DOB"]);
       $results["tomsk_bank_clients_kronos_2013"] = search_tomsk_bank_clients_kronos_2013_by_name_dob($_POST["surname"],$_POST["firstname"],null,$_POST["DOB"]);
       $results["unknown_10k"] = search_unknown_10k_by_name_dob($_POST["surname"],$_POST["firstname"],null,$_POST["DOB"]);
      // $results["covid19_move"] = search_covid19_move_by_name($_POST["surname"],$_POST["firstname"]);
       $results["manual_inserted"] = search_manual_inserted_by_name_dob($_POST["surname"],$_POST["firstname"],null,$_POST["DOB"]);
       $results["puma21"] = search_puma21_by_name_dob($_POST["surname"],$_POST["firstname"],null,$_POST["DOB"]);
       $results["sportmaster"] = search_sportmaster_by_name_dob($_POST["surname"],$_POST["firstname"],null,$_POST["DOB"]);
       $results["gemotest"] = search_gemotest_by_name_dob($_POST["surname"],$_POST["firstname"],null,$_POST["DOB"]);
        $request=$_POST["surname"]." ".$_POST["firstname"]." ".$_POST["DOB"];
          $x=9;
    }
    else if(!empty($_POST["firstname"]))
    {
           file_put_contents("log10.txt","failed search");
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
        $request=$_POST["surname"]." ".$_POST["firstname"];
          $x=10;
    }
    else
    {
        $request=$_POST["surname"];
         $error="Недостаточно данных для поиска. Введите хотя бы имя."; 
    }
  
   
}
if(!empty($_POST["phone"]))
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

   $request=$_POST["phone"];
   $x=8;
}


if(!empty($_POST["email"]))
{
    $results=array();
   $results["esia"] = search_esia_by_email($_POST["email"]);
   $results["covid19_move"] = search_covid19_move_by_email($_POST["email"]);
   $results["puma21"] = search_puma21_by_email($_POST["email"]);
    $results["unknown_10k"] = search_unknown_10k_by_email($_POST["email"]);
   $results["manual_inserted"] = search_manual_inserted_by_email($_POST["email"]);
    $results["sportmaster"] = search_sportmaster_by_email($_POST["email"]);

     $request=$_POST["email"];
    $x=6;
}
$j=0;
$m=array();
    foreach($results as $base => $v)
    {
        if(count($v)<1)
        {
             $j++;
        }
        else
        {
            $m[$base]=$v;
        }
       
    }
    if($j==$x)
    {
        
       $m["nothing_found"]="Ничего не найдено"; 
    }
    if(!empty($error))
    {
         
       $m["nothing_found"]=$error; 
    }
  
 $sql="INSERT INTO search_requests (user_id, request, result, tags) VALUES (?,?,?,?)";
$statement = $pdo->prepare($sql);
$statement->execute(array($user["id"],$request,json_encode($m),""));

file_put_contents("log.txt","success search");

}
catch(Exception $ex)
{
    file_put_contents("log.txt",$ex);
}
?>