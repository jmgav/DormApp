<?php
require_once 'functions.php';
require_once 'class_login.php';


 
        if(isset($_SESSION['dormappid'])){ /*if user is logged in, displays welome (name) */
    ?>
        
 <?php 
 
       }else{ ?> <!--else if user is not logged in, displays the login now box-->
  	<h2><span>login</span> now</h2>
	<ul>
	<form method="post" action="index.php">
            <label for="username">Username:</label>
            <input name="username" placeholder="Email" /> <br/>
            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="Password"/>
            <input type="submit" name="login" value="Login" />
        </form>
	</ul>         
        <?php }

if($_SERVER['REQUEST_METHOD']=='POST'){  login_class::login($_POST['username'],$_POST['password']); /*login function*/
 
    if(login_class::is_logged_in()){
        echo 'successfully logged-in!';  /*after sucesfull login, redirects to profile*/
    }
    else{
        echo "<p id=\"loginerror\">&nbspWrong Email or Password!</p>"; /*unsecesfull login displays error message*/
    }
 
 }
 
 
 ?> 