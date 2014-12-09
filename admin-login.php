<?php
require_once 'functions.php';
require_once 'class_login.php';
include 'head.php';
 ?>	   
 
 <div class="row">
<div class="col-sm-12">
<div class="media" style="margin-bottom: 15px; margin-top: 15px;">
<img class="pull-left" src="./images/seal-80x80.png">
<div class="media-body">
<h1 style="color: #7B1113; margin: 0">Dorm Application System</h1>
<h4 style="margin-top: 0"><span style="color: #335628">OFFICE OF STUDENT AFFAIRS</span>
<br>
<span style="color: #8E171A">UNIVERSITY OF THE PHILIPPINES VISAYAS</span></h4>
</div>
</div>
</div>

</div>
	   <div class="row login-row">
	   <div class="col-sm-4">
	   </div>
    	    <div class="col-sm-4">
        	    <div class="form-wrap text-center">
                <h2>Admin Login</h2>
                    <form action="admin-login" method="post">
	
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
                   
        
    	
    	
	      
        <?php 

if($_SERVER['REQUEST_METHOD']=='POST'){  

login_class::admin_login($_POST['username'],$_POST['password']); /*login function*/
 
    if(login_class::is_logged_in_admin()){
       head(adminindex,""); 
    }
    else{
        echo "<br/><button type='button' class='btn btn-danger' id='wronglogin'>Wrong Username or Password!</button>"; /*unsecesfull login displays error message*/
    }
 
 }

 ?> 
 	    </div>
 	</div> <!-- /.col-xs-12 -->
</div>