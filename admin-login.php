<?php
require_once 'functions.php';
require_once 'class_login.php';
include 'head.php';

 
        if(isset($_SESSION['dormappid'])){ /*if user is logged in, displays welome (name) */
    ?>
        hello
 <?php 
 
       }else{ ?> <!--else if user is not logged in, displays the login now box-->
	   
	   <div class="row login-row">
    	    <div class="col-xs-12">
        	    <div class="form-wrap text-center">
                <h2>Admin Login</h2>
                    <form action="admin-login.php" method="post">
	
                        <div class="form-group">
                            <label for="username" class="sr-only">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Username" />
                        </div>
                        <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" />
                        </div>
                       
                        <input type="submit" id="btn-login" class="btn btn-custom btn-block" value="Log in" />
                    </form>
                   
        
    	
    	
	      
        <?php }

if($_SERVER['REQUEST_METHOD']=='POST'){  login_class::login($_POST['username'],$_POST['password']); /*login function*/
 
    if(login_class::is_logged_in()){
       head(adminindex,""); 
    }
    else{
        echo "<button type='button' class='btn btn-danger' id='wronglogin'>Wrong Username or Password!</button>"; /*unsecesfull login displays error message*/
    }
 
 }

 ?> 
 	    </div>
 	</div> <!-- /.col-xs-12 -->
</div>