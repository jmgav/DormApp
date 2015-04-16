<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

require_once 'dbconnection.php';

$date_open_application = 'April 14, 2015';
$date_close_application = 'April 24, 2015';
$date_deadline_requirements = 'April 28, 2015';
$date_post_results = 'May 8, 2015';
$date_check_in = '';
$date_confirmation_start = 'May 9, 2015';
$date_confirmation_end = 'May 15, 2015';

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

function additional_instructions($id){

global $date_deadline_requirements;

 $result = mysql_query("SELECT dorm_name FROM applicants WHERE `student_number`='$id'") or die(mysql_error());

 $row = mysql_fetch_assoc($result);
	
	if($row['dorm_name']=='hall1'){ 
	$dorm='Balay Lampirong';
	$send='Balay Lampirong, University of the Philippines Visayas, Miag-ao, Iloilo';
	}
	else if($row['dorm_name']=='hall2'){ 
	$dorm='Balay Kanlaon';
	$send='Balay Kanlaon, University of the Philippines Visayas, Miag-ao, Iloilo';
	}
	else if($row['dorm_name']=='ilonggo'){ 
	$dorm='Balay Ilonggo';
	$send='Balay Ilonggo, University of the Philippines Visayas, Molo, Iloilo City';
	}
?>
 <p><b>Instructions for additional dorm requirements.</b></p>
  
  <p>To proceed with your application, you need to send the following documents via courier (LBC, Xend, 2GO etc.) to <b><? echo $dorm; ?></b>.</p>
  <ul class="list-unstyled">
<li>a. UPCAT Admission Notice</li>
<li>b. Certificate of Good Moral Character</li>
<li>c. Income Tax Return for AY 2014</li>
<li>d. Special Power of Attorney (for Guardians)</li>
<li>e. 3 pcs. 2x2 ID picture</li>
<li>f. Cream folder (long)</li>
  </ul>
 <p>Please send these documents via courier to <b><? echo $send; ?></b></p>
 <p>The deadline for acceptance of these documents (including delays on the courier) will be on <b><? echo $date_deadline_requirements; ?>.</b></p>
  
  
<?php
}
