<?php
require_once 'dbconnection.php';
include 'functions.php';
dbconnection::getConnection();
require_once 'class_login.php';

$name=$_SESSION['firstnameadmin'].' '.$_SESSION['lastnameadmin'];
$dorm=$_SESSION['dormnameadmin'];


$query=mysql_query("INSERT INTO publish VALUES(now(),'$name','$dorm')") or die(mysql_error());

head(adminindex,'');
?>