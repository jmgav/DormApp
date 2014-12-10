<?php
require_once 'dbconnection.php';

function head($page,$extension){
    $host = $_SERVER['HTTP_HOST'];
    $folder = rtrim(dirname($_SERVER['PHP_SELF']),'/\\'); 
    header ("Location:http://$host$folder/$page$extension");
}

function redirect_to_home(){    /*function to redirect the user ot his profile page, or admin page if he is an administrator*/

    head(profile,""); 
    exit();
    
}

function redirect_to_welcome(){
    head(index,""); 
    exit();
}

function redirect_to_loan(){
   head(loan,"");
   exit;
}

function logdata($data,$arg){
  // date_default_timezone_set("Asia/Manila");
$my_file = "log ".date('m-d-Y',time()-(60*60*8)).'.txt';

if($arg!=null){
 $uid=$arg;   
 dbconnection::getConnection();

$query=mysql_query("SELECT firstname,lastname FROM `personalinfo` WHERE userid=$uid")  or  die(mysql_error());    
$row = mysql_fetch_assoc($query);

$handle = fopen('./logs/'.$my_file, 'a') or die('Cannot open file:  '.$my_file);
fwrite($handle, 'User '.$row['firstname']." ".$row['lastname'].$data.' at '.date('g:i A'). "\r\n");
}else{
    
$handle = fopen('./logs/'.$my_file, 'a') or die('Cannot open file:  '.$my_file);
fwrite($handle, "New user".$data.' at '.date('g:i A'). "\r\n");
    
    
}


}

?>