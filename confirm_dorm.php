<?php
require_once 'dbconnection.php';
include 'functions.php';
require_once 'class_login.php';
dbconnection::getConnection();

if(!login_class::is_logged_in_student()) head(index,'');

$id=$_GET['id'];

$query=mysql_query("UPDATE applicants SET `confirm_flag`='confirmed' WHERE student_number='$id'")or die(mysql_error());

head(file,'');
?>