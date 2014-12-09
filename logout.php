<?php
require_once 'functions.php';
require_once 'class_login.php';

if(login_class::is_logged_in_student() || login_class::is_logged_in_admin()){ 
    session_destroy();  
}

redirect_to_welcome();
?>
