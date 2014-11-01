<?php
require_once 'functions.php';
require_once 'class_login.php';

if(login_class::is_logged_in()){ 
    session_destroy();  
}

redirect_to_welcome();
?>
