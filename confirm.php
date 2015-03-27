<?php
require_once 'dbconnection.php';
include 'functions.php';
dbconnection::getConnection();
require_once 'class_login.php';


$name=$_SESSION['firstnameadmin'].' '.$_SESSION['lastnameadmin'];

$query=mysql_query("INSERT INTO deadline VALUES(now(),'$name','closed')") or die(mysql_error());

head(adminindex,'');
?>