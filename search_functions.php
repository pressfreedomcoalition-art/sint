<?php
//search by name & dob
function search_esia_by_name_dob($surname, $name=null, $patronymic=null, $dob=null)
{
    global $esia_tables;
    global $pdo;
    $result=array();
    foreach($esia_tables as $table){
        $r=array();
        if(isset($name) && isset($patronymic) && isset($dob) )
        {
$statement = $pdo->prepare("SELECT * FROM ".$table." WHERE field5 LIKE '%".$surname."%' AND field6 LIKE '%".$name."%' AND field7 LIKE '%".$patronymic."%' AND field12 LIKE '%".$dob."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else if(isset($name) && isset($patronymic))
        {
$statement = $pdo->prepare("SELECT * FROM ".$table." WHERE field5 LIKE '%".$surname."%' AND field6 LIKE '%".$name."%' AND field7 LIKE '%".$patronymic."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else if(isset($name) && isset($dob))
        {
$statement = $pdo->prepare("SELECT * FROM ".$table." WHERE field5 LIKE '%".$surname."%' AND field6 LIKE '%".$name."%' AND field12 LIKE '%".$dob."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC); 
        }
        else if (isset($name))
        {
            
$statement = $pdo->prepare("SELECT * FROM ".$table." WHERE field5 LIKE '%".$surname."%' AND field6 LIKE '%".$name."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);   

        }
        if(isset($r)){
        $result = array_merge($result, $r);
        }
    }

return $result;
}

function search_rosreestr_owners_by_name_dob($surname, $name=null, $patronymic=null, $dob=null)
{
   
    global $pdo;
    $r=array();
   
        if(isset($name) && isset($patronymic) && isset($dob) )
        {
$statement = $pdo->prepare("SELECT * FROM rosreestr_owners WHERE owner LIKE '%".$surname." ".$name." ".$patronymic."%' AND dob LIKE '%".$dob."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else if(isset($name) && isset($patronymic))
        {
$statement = $pdo->prepare("SELECT * FROM rosreestr_owners WHERE owner LIKE '%".$surname." ".$name." ".$patronymic."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else if(isset($name) && isset($dob))
        {
$statement = $pdo->prepare("SELECT * FROM rosreestr_owners WHERE owner LIKE '%".$surname." ".$name."%' AND dob LIKE '%".$dob."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else if (isset($name))
        {
$statement = $pdo->prepare("SELECT * FROM rosreestr_owners WHERE owner LIKE '%".$surname." ".$name."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC); 
        }
     
    
if(isset($r))
{
return $r;
}
else
{
    $emp=array();
    return $emp;
}
}

function search_sirena_2019_by_name_dob($surname, $name=null, $patronymic=null, $dob=null)
{
   
    global $pdo;
    $r=array();
   
        if(isset($name) && isset($patronymic) && isset($dob) )
        {
$statement = $pdo->prepare("SELECT * FROM sirena_2019 WHERE fio LIKE '%".$surname." ".$name." ".$patronymic."%' AND dob LIKE '%".$dob."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else if(isset($name) && isset($patronymic))
        {
$statement = $pdo->prepare("SELECT * FROM sirena_2019 WHERE fio LIKE '%".$surname." ".$name." ".$patronymic."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else if(isset($name) && isset($dob))
        {
$statement = $pdo->prepare("SELECT * FROM sirena_2019 WHERE fio LIKE '%".$surname." ".$name."%' AND dob LIKE '%".$dob."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else if (isset($name))
        {
$statement = $pdo->prepare("SELECT * FROM sirena_2019 WHERE fio LIKE '%".$surname." ".$name."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
     
    
if(isset($r))
{
return $r;
}
else
{
    $emp=array();
    return $emp;
}
}
function search_tomsk_bank_clients_kronos_2013_by_name_dob($surname, $name=null, $patronymic=null, $dob=null)
{
   
    global $pdo;
    $r=array();
   
        if(isset($name) && isset($patronymic) && isset($dob) )
        {
$statement = $pdo->prepare("SELECT * FROM tomsk_bank_clients_kronos_2013 WHERE last_name LIKE '%".$surname."%' AND first_name LIKE '%".$name."%' AND middle_name LIKE '%".$patronymic."%' AND dob LIKE '%".$dob."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else if(isset($name) && isset($patronymic))
        {
$statement = $pdo->prepare("SELECT * FROM tomsk_bank_clients_kronos_2013 WHERE last_name LIKE '%".$surname."%' AND first_name LIKE '%".$name."%' AND middle_name LIKE '%".$patronymic."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else if(isset($name) && isset($dob))
        {
$statement = $pdo->prepare("SELECT * FROM tomsk_bank_clients_kronos_2013 WHERE last_name LIKE '%".$surname."%' AND first_name LIKE '%".$name."%' AND dob LIKE '%".$dob."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else if (isset($name))
        {
$statement = $pdo->prepare("SELECT * FROM tomsk_bank_clients_kronos_2013 WHERE last_name LIKE '%".$surname."%' AND first_name LIKE '%".$name."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
     
    
if(isset($r))
{
return $r;
}
else
{
    $emp=array();
    return $emp;
}
}
function search_unknown_10k_by_name_dob($surname, $name=null, $patronymic=null, $dob=null)
{
   
    global $pdo;
    $r=array();
   
        if(isset($name) && isset($patronymic) && isset($dob) )
        {
$statement = $pdo->prepare("SELECT * FROM unknown_10k WHERE surname LIKE '%".$surname."%' AND name LIKE '%".$name."%' AND patronymic LIKE '%".$patronymic."%' AND dob LIKE '%".$dob."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else if(isset($name) && isset($patronymic))
        {
$statement = $pdo->prepare("SELECT * FROM unknown_10k WHERE surname LIKE '%".$surname."%' AND name LIKE '%".$name."%' AND patronymic LIKE '%".$patronymic."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else if(isset($name) && isset($dob))
        {
$statement = $pdo->prepare("SELECT * FROM unknown_10k WHERE surname LIKE '%".$surname."%' AND name LIKE '%".$name."%' AND dob LIKE '%".$dob."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else if (isset($name))
        {
$statement = $pdo->prepare("SELECT * FROM unknown_10k WHERE surname LIKE '%".$surname."%' AND name LIKE '%".$name."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
     
    
if(isset($r))
{
return $r;
}
else
{
    $emp=array();
    return $emp;
}
}

function search_covid19_move_by_name($surname, $name=null, $patronymic=null)
{
   
    global $pdo;
    $r=array();
   
       if(isset($name) && isset($patronymic))
        {
$statement = $pdo->prepare("SELECT * FROM covid19_move WHERE full_name LIKE '%".$surname." ".$name." ".$patronymic."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else if (isset($name))
        {
$statement = $pdo->prepare("SELECT * FROM sirena_2019 WHERE fio LIKE '%".$surname." ".$name."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
     
    
if(isset($r))
{
return $r;
}
else
{
    $emp=array();
    return $emp;
}
}

function search_manual_inserted_by_name_dob($surname, $name=null, $patronymic=null, $dob=null)
{
   
    global $pdo;
    $r=array();
   
        if(isset($name) && isset($patronymic) && isset($dob) )
        {
$statement = $pdo->prepare("SELECT * FROM manual_inserted WHERE surname LIKE '%".$surname."%' AND firstname LIKE '%".$name."%' AND patronymic LIKE '%".$patronymic."%' AND dob LIKE '%".$dob."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else if(isset($name) && isset($patronymic))
        {
$statement = $pdo->prepare("SELECT * FROM manual_inserted WHERE surname LIKE '%".$surname."%' AND firstname LIKE '%".$name."%' AND patronymic LIKE '%".$patronymic."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else if(isset($name) && isset($dob))
        {
$statement = $pdo->prepare("SELECT * FROM manual_inserted WHERE surname LIKE '%".$surname."%' AND firstname LIKE '%".$name."%' AND dob LIKE '%".$dob."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else if (isset($name))
        {
$statement = $pdo->prepare("SELECT * FROM manual_inserted WHERE surname LIKE '%".$surname."%' AND firstname LIKE '%".$name."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
     
    
if(isset($r))
{
return $r;
}
else
{
    $emp=array();
    return $emp;
}
}

function search_puma21_by_name_dob($surname, $name=null, $patronymic=null, $dob=null)
{
   
    global $pdo;
    $r=array();
   
        if(isset($name) && isset($patronymic) && isset($dob) )
        {
$statement = $pdo->prepare("SELECT * FROM puma21 WHERE fio LIKE '%".$name." ".$patronymic." ".$surname."%' AND dob LIKE '%".$dob."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else if(isset($name) && isset($patronymic))
        {
$statement = $pdo->prepare("SELECT * FROM puma21 WHERE fio LIKE '%".$name." ".$patronymic." ".$surname."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else if(isset($name) && isset($dob))
        {
$statement = $pdo->prepare("SELECT * FROM puma21 WHERE fio LIKE '%".$name." ".$surname."%' AND dob LIKE '%".$dob."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else if (isset($name))
        {
$statement = $pdo->prepare("SELECT * FROM puma21 WHERE fio LIKE '%".$name." ".$surname."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
     
    
if(isset($r))
{
return $r;
}
else
{
    $emp=array();
    return $emp;
}
}

function search_sportmaster_by_name_dob($surname, $name=null, $patronymic=null, $dob=null)
{
   
    global $pdo;
    $r=array();
   
        if(isset($name) && isset($patronymic) && isset($dob) )
        {
            $bir="";
            try{
            $l=explode(".", $dob);
            $bir=implode('-', array_reverse($l));
            }
            catch(Exception $ex)
            {
                
            }
$statement = $pdo->prepare("SELECT * FROM sportmaster WHERE fio LIKE '%".$surname." ".$name." ".$patronymic."%' AND dob LIKE '%".$bir."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else if(isset($name) && isset($patronymic))
        {
$statement = $pdo->prepare("SELECT * FROM sportmaster WHERE fio LIKE '%".$surname." ".$name." ".$patronymic."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else if(isset($name) && isset($dob))
        {
              $bir="";
            try{
            $l=explode(".", $dob);
            $bir=implode('-', array_reverse($l));
            }
            catch(Exception $ex)
            {
                
            }
$statement = $pdo->prepare("SELECT * FROM sportmaster WHERE fio LIKE '%".$surname." ".$name."%' AND dob LIKE '%".$bir."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else if (isset($name))
        {
$statement = $pdo->prepare("SELECT * FROM sportmaster WHERE fio LIKE '%".$surname." ".$name."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
     
    
if(isset($r))
{
return $r;
}
else
{
    $emp=array();
    return $emp;
}
}

function search_gemotest_by_name_dob($surname, $name=null, $patronymic=null, $dob=null)
{
   
    global $pdo;
    $r=array();
   
        if(isset($name) && isset($patronymic) && isset($dob) )
        {
            $bir="";
            try{
            $l=explode(".", $dob);
            $bir=implode('-', array_reverse($l));
            }
            catch(Exception $ex)
            {
                
            }
$statement = $pdo->prepare("SELECT * FROM gemotest WHERE last_name LIKE '%".$surname."%' AND first_name LIKE '%".$name."%' AND middle_name LIKE '%".$patronymic."%' AND birth_date LIKE '%".$bir."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else if(isset($name) && isset($patronymic))
        {
$statement = $pdo->prepare("SELECT * FROM gemotest WHERE last_name LIKE '%".$surname."%' AND first_name LIKE '%".$name."%' AND middle_name LIKE '%".$patronymic."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else if(isset($name) && isset($dob))
        {
             $bir="";
            try{
            $l=explode(".", $dob);
            $bir=implode('-', array_reverse($l));
            }
            catch(Exception $ex)
            {
                
            }
$statement = $pdo->prepare("SELECT * FROM gemotest WHERE last_name LIKE '%".$surname."%' AND first_name LIKE '%".$name."%' AND birth_date LIKE '%".$bir."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else if (isset($name))
        {
$statement = $pdo->prepare("SELECT * FROM gemotest WHERE last_name LIKE '%".$surname."%' AND first_name LIKE '%".$name."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
     
    
if(isset($r))
{
return $r;
}
else
{
    $emp=array();
    return $emp;
}
}

//search by phone
function search_esia_by_phone($phone)
{
    global $esia_tables;
    global $pdo;
    $result=array();
    foreach($esia_tables as $table){
    
$statement = $pdo->prepare("SELECT * FROM ".$table." WHERE field25 LIKE '%".$phone."%';");  
$statement->execute();
$r=$statement->fetch(PDO::FETCH_ASSOC);
$ph=$phone;
$ph=substr_replace($ph, '(', 1, 0);
$ph=substr_replace($ph, ')', 5, 0);
$statement = $pdo->prepare("SELECT * FROM ".$table." WHERE field25 LIKE '%".$ph."%';");  
$statement->execute();
$r1=$statement->fetchAll(PDO::FETCH_ASSOC);
        
       
        if(isset($r)){
        $result = array_merge($result, $r);
        }
         if(isset($r1)){
        $result = array_merge($result, $r1);
        }
    }

return $result;
}

function search_covid19_move_by_phone($phone)
{
    
    global $pdo;
    $r=array();
 
     
$statement = $pdo->prepare("SELECT * FROM covid19_move WHERE phone LIKE '%".$phone."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);

        
       
  if(isset($r))
{
return $r;
}
else
{
    $emp=array();
    return $emp;
}    
}

function search_puma21_by_phone($phone)
{
    
    global $pdo;
    $r=array();
 
      
$statement = $pdo->prepare("SELECT * FROM puma21 WHERE phone LIKE '%".$phone."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);

       
  if(isset($r))
{
return $r;
}
else
{
    $emp=array();
    return $emp;
}    
}

function search_getcontact_by_phone($phone)
{
    
    global $pdo;
    $r=array();
 
      
$statement = $pdo->prepare("SELECT * FROM getcontact WHERE number LIKE '%".$phone."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);

       
  if(isset($r))
{
return $r;
}
else
{
    $emp=array();
    return $emp;
}    
}

function search_sportmaster_by_phone($phone)
{
    
    global $pdo;
    $r=array();
 
      
$statement = $pdo->prepare("SELECT * FROM sportmaster WHERE phone LIKE '%".$phone."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);

       
  if(isset($r))
{
return $r;
}
else
{
    $emp=array();
    return $emp;
}    
}

function search_gemotest_by_phone($phone)
{
    
    global $pdo;
    $r=array();
 
      
$statement = $pdo->prepare("SELECT * FROM gemotest WHERE mobile_phone LIKE '%".$phone."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);

       
  if(isset($r))
{
return $r;
}
else
{
    $emp=array();
    return $emp;
}    
}

function search_unknown_10k_by_phone($phone)
{
    
    global $pdo;
    $r=array();
 
      
$statement = $pdo->prepare("SELECT * FROM puma21 WHERE phone LIKE '%".$phone."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);

       
  if(isset($r))
{
return $r;
}
else
{
    $emp=array();
    return $emp;
}    
}

function search_manual_inserted_by_phone($phone)
{
    
    global $pdo;
    $r=array();
 
      
$statement = $pdo->prepare("SELECT * FROM manual_inserted WHERE phones LIKE '%".$phone."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);

       
  if(isset($r))
{
return $r;
}
else
{
    $emp=array();
    return $emp;
}    
}

//search by email
function search_esia_by_email($email)
{
    global $esia_tables;
    global $pdo;
    $result=array();
    foreach($esia_tables as $table){
    
$statement = $pdo->prepare("SELECT * FROM ".$table." WHERE field24 LIKE '%".$email."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);

        
       
        if(isset($r)){
        $result = array_merge($result, $r);
        }
      
    }

return $result;
}

function search_covid19_move_by_email($email)
{
    
    global $pdo;
    $r=array();
 
      
$statement = $pdo->prepare("SELECT * FROM covid19_move WHERE email LIKE '%".$email."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);

       
  if(isset($r))
{
return $r;
}
else
{
    $emp=array();
    return $emp;
}    
}

function search_puma21_by_email($email)
{
    
    global $pdo;
    $r=array();
 
      
$statement = $pdo->prepare("SELECT * FROM puma21 WHERE email LIKE '%".$email."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);

       
  if(isset($r))
{
return $r;
}
else
{
    $emp=array();
    return $emp;
}    
}

function search_unknown_10k_by_email($email)
{
    
    global $pdo;
    $r=array();
 
      
$statement = $pdo->prepare("SELECT * FROM unknown_10k WHERE email LIKE '%".$email."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);

       
  if(isset($r))
{
return $r;
}
else
{
    $emp=array();
    return $emp;
}    
}

function search_manual_inserted_by_email($email)
{
    
    global $pdo;
    $r=array();
 
      
$statement = $pdo->prepare("SELECT * FROM manual_inserted WHERE emails LIKE '%".$email."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);

       
  if(isset($r))
{
return $r;
}
else
{
    $emp=array();
    return $emp;
}    
}

function search_sportmaster_by_email($email)
{
    
    global $pdo;
    $r=array();
 
      
$statement = $pdo->prepare("SELECT * FROM sportmaster WHERE email LIKE '%".$email."%';");  
$statement->execute();
$r=$statement->fetchAll(PDO::FETCH_ASSOC);

       
  if(isset($r))
{
return $r;
}
else
{
    $emp=array();
    return $emp;
}    
}
?>