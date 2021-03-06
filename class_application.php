<?php
require_once 'dbconnection.php';
include_once 'class_login.php';
include_once 'functions.php';
dbconnection::getConnection();

class class_application {
    private static $instance = null;
    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new class_application();
        }
        return self::$instance;
    }    

public static function submit_app($dn,$fn,$ln,$mn,$gen,$sn,$co,$yl,$un,$pa,$hd,$ma,$la,$mo,$mon,$fan,$moo,$fao,$moa,$faa,
								  $mol,$mom,$fal,$fam,$gn,$ga,$re,$gl,$gm,$sc,$in){    
$query_flag=1;   

$firstname = ucwords(strtolower(filter_var($fn,FILTER_SANITIZE_STRING)));
$lastname = ucwords(strtolower(filter_var($ln,FILTER_SANITIZE_STRING)));
$middlename = ucwords(strtolower(filter_var($mn,FILTER_SANITIZE_STRING)));
$student_number = $sn;
$course = filter_var($co,FILTER_SANITIZE_STRING);
$year_level = filter_var($yl,FILTER_VALIDATE_INT);
$units = filter_var($un,FILTER_VALIDATE_INT);
$perm_address=ucwords(strtolower(filter_var($pa,FILTER_SANITIZE_STRING)));
$home_distance=$hd;
$mailing_address=ucwords(strtolower(filter_var($ma,FILTER_SANITIZE_STRING)));
$landline=$la;
$mobile=$mo;
 
$mother_name= ucwords(strtolower(filter_var($mon,FILTER_SANITIZE_STRING)));
$father_name= ucwords(strtolower(filter_var($fan,FILTER_SANITIZE_STRING)));
$mother_occupation= ucwords(strtolower(filter_var($moo,FILTER_SANITIZE_STRING)));
$father_occupation= ucwords(strtolower(filter_var($fao,FILTER_SANITIZE_STRING)));
$mother_address= ucwords(strtolower(filter_var($moa,FILTER_SANITIZE_STRING)));
$father_address= ucwords(strtolower(filter_var($faa,FILTER_SANITIZE_STRING)));
$mother_landline= $mol;
$mother_mobile= $mom;
$father_landline= $fal;
$father_mobile= $fam;
  
$guardian_name= ucwords(strtolower(filter_var($gn,FILTER_SANITIZE_STRING)));
$guardian_address= ucwords(strtolower(filter_var($ga,FILTER_SANITIZE_STRING)));
$relationship = ucwords(strtolower(filter_var($re,FILTER_SANITIZE_STRING)));
$guardian_landline= $gl;
$guardian_mobile= $gm;

$scholarship= strtolower(filter_var($sc,FILTER_SANITIZE_STRING));
$income=$in;

$points_total=0;

$home_points=$home_distance/6;

if($home_points>=50){
$points_total+=50;
}
else{
$points_total+=round($home_points,0);
}

 
switch($income){

case '1300001':
	$points_total+=15;
	break;
case '650001':
	$points_total+=25;
	break;
case '325001':
	$points_total+=30;
	break;
case '135001':
	$points_total+=35;
	break;
case '80001':
	$points_total+=40;
	break;
case '80000':
	$points_total+=50;
	break;
}

if($query_flag==1){		
      
	  
mysql_query("INSERT INTO applicants VALUES(0,now(),'$dn','$firstname','$lastname','$middlename','$gen','$student_number',
'$course','$year_level','$units','$perm_address','$home_distance','$mailing_address','$landline','$mobile','$mother_name',
'$father_name','$mother_address','$father_address','$mother_occupation','$father_occupation','$mother_landline',
'$mother_mobile','$father_landline','$father_mobile','$guardian_name','$guardian_address','$relationship',
'$guardian_landline','$guardian_mobile','$scholarship','$income','$points_total','Pending','unconfirmed','no remarks')") or die("Error in query:".mysql_error());	

mysql_query("UPDATE users SET `flag`=1 WHERE `student_number`='$student_number'") or die("Error in query:".mysql_error());	

head(file,'');
}	

    }  
	
	
	
public static function submit_edited_app($id,$fn,$ln,$mn,$gen,$co,$yl,$un,$ma,$la,$mo,$mon,$fan,$moo,$fao,$moa,$faa,
								  $mol,$mom,$fal,$fam,$gn,$ga,$re,$gl,$gm,$rm){    
$query_flag=1;   

$firstname = ucwords(strtolower(filter_var($fn,FILTER_SANITIZE_STRING)));
$lastname = ucwords(strtolower(filter_var($ln,FILTER_SANITIZE_STRING)));
$middlename = ucwords(strtolower(filter_var($mn,FILTER_SANITIZE_STRING)));

$course = filter_var($co,FILTER_SANITIZE_STRING);
$year_level = filter_var($yl,FILTER_VALIDATE_INT);
$units = filter_var($un,FILTER_VALIDATE_INT);
$mailing_address=ucwords(strtolower(filter_var($ma,FILTER_SANITIZE_STRING)));
$landline=$la;
$mobile=$mo;
 
$mother_name= ucwords(strtolower(filter_var($mon,FILTER_SANITIZE_STRING)));
$father_name= ucwords(strtolower(filter_var($fan,FILTER_SANITIZE_STRING)));
$mother_occupation= ucwords(strtolower(filter_var($moo,FILTER_SANITIZE_STRING)));
$father_occupation= ucwords(strtolower(filter_var($fao,FILTER_SANITIZE_STRING)));
$mother_address= ucwords(strtolower(filter_var($moa,FILTER_SANITIZE_STRING)));
$father_address= ucwords(strtolower(filter_var($faa,FILTER_SANITIZE_STRING)));
$mother_landline= $mol;
$mother_mobile= $mom;
$father_landline= $fal;
$father_mobile= $fam;
  
$guardian_name= ucwords(strtolower(filter_var($gn,FILTER_SANITIZE_STRING)));
$guardian_address= ucwords(strtolower(filter_var($ga,FILTER_SANITIZE_STRING)));
$relationship = ucwords(strtolower(filter_var($re,FILTER_SANITIZE_STRING)));
$guardian_landline= $gl;
$guardian_mobile= $gm;
$remarks = filter_var($rm,FILTER_SANITIZE_STRING);



if($query_flag==1){		
      
mysql_query("UPDATE applicants SET firstname='$firstname' ,lastname='$lastname' ,middlename='$middlename',gender='$gen', landline='$landline', mobile='$mobile', course='$course', year_level='$year_level', units_enrolled='$units',
mother_job='$mother_occupation',father_job='$father_occupation',
mother_landline='$mother_landline',mother_mobile='$mother_mobile',father_landline='$father_landline',father_mobile='$father_mobile',
guardian_name='$guardian_name',guardian_address='$guardian_address',guardian_relationship='$relationship',
guardian_landline='$guardian_landline',guardian_mobile='$guardian_mobile', remarks='$remarks' WHERE id='$id'") or die("Error in query:".mysql_error());	

echo "<div class='alert alert-success' role='alert'>The application has been edited.</div>";

echo '<meta http-equiv="refresh" content="1">';

		 }	

    }  
 
}
?>
