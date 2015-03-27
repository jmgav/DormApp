<?php
require_once 'dbconnection.php';
include 'functions.php';
require_once 'class_login.php';
dbconnection::getConnection();

if(!login_class::is_logged_in_admin()) head(index,'');

$id=$_GET['id'];

$query=mysql_query("UPDATE applicants SET `accept_flag`='Pending' WHERE id='$id'")or die(mysql_error());

head(view,'?id='.$id);
?>