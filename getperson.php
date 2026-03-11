<?php
include("config.php");
$output=array();

 if(!empty($_GET["hash"]))
 {
     $statement = $pdo->prepare("SELECT * FROM faggots WHERE hash=?");  
$statement->execute(array($_GET["hash"]));
$f=$statement->fetch(PDO::FETCH_ASSOC); 
$output["id"]=$f["id"];
$output["full_name"]=$f["fio"];
$output["birth_date"]=$f["dob"];
$output["country"]=null;
$output["country_code"]=null;
$output["city"]=null;
$output["photo_url"]=null;
$output["identity_documents"]=null;
$output["additional_info"]=null;
if(!empty($f["comments"]))
{
    $output["additional_info"]=$f["comments"];
}
$output["social_networks"]=array();
$output["phones"]=array();
$output["court_decisions"]=array();
$output["labels"]=array();
$output["debt_amount"]=array();
$output["debt_amount"][]=array();
$output["debt_amount"][0]["currency"]="USD";
$output["debt_amount"][0]["amount"]="";
$output["status"]=null;
$output["special_marks"]=null;
$output["criminal_organizations"]=array();

$results=json_decode($f["data"],true);
if(!isset($results["nothing_found"])){
    foreach($results as $base => $v)
    {
        if(count($v)>0)
        {
           
          
             foreach($v as $d)
            {
                   if($base=="sirena_2019")
                     {
                         $output["identity_documents"]=$d["passport"];
                     }
                     if($base=="esia")
                     {

                         $output["identity_documents"]=$d["field17"];
                     }
                       if($base=="covid19_move")
                     {
                         $output["identity_documents"]=$d["passport"];
                     }
                 foreach($d as $k => $l)
                 {
                     if(!empty($l) && ($k=="phone" || $k=="phones"))
                     {
                         $output["phones"][]=$l;
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

echo json_encode($output);
 }
?>