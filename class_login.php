<?php
require_once 'dbconnection.php';
dbconnection::getConnection(); /*creates a connection to the database*/

error_reporting(E_ALL);
session_name('dormapp');
session_start();

class login_class {
    private static $instance = null;
    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new login_class();
        }
        return self::$instance;
    }   
 
public static function login($username,$password){

$result=mysql_query("SELECT * FROM users WHERE username='$username' AND password=md5('$password')")or die(mysql_error());
  
if(mysql_num_rows($result) == 1){ /*if a users login information is found in the database, sets the SESSION variables*/
        $row = mysql_fetch_assoc($result);
        $_SESSION['dormappid'] = $row['id'];
        $_SESSION['username'] = $row['username'];
		$_SESSION['student_number'] = $row['student_number'];
			   
		if(md5($row['student_number'])==$row['password']){
        return 'reset'; 
		}
		
		else{
		
		return 'file';
		}
			
}
else{
return false; 
}

}

public static function change_password($pass,$pass2,$user){
	if($pass!=$pass2){
	return 'no_match';
	}
	else{
	$query=mysql_query("UPDATE users set password=md5('$pass') WHERE id='$user'") or die(mysql_error());
	return 'ok';
	}
}

public static function admin_login($username,$password){ /*funtion to login*/

$result=mysql_query("SELECT * FROM admins WHERE username='$username' AND password=md5('$password')")or die(mysql_error());
  
if(mysql_num_rows($result) == 1){ /*if a users login information is found in the database, sets the SESSION variables*/
        $row = mysql_fetch_assoc($result);
        $_SESSION['dormappadminid'] = $row['id'];
		$_SESSION['dormnameadmin'] = $row['dorm_name'];
        $_SESSION['usernameadmin'] = $row['username'];
		$_SESSION['firstnameadmin'] = $row['firstname'];
		$_SESSION['lastnameadmin'] = $row['lastname'];
        
        return true; /*for TDD test purposes, indicator of sucesful login*/
}

else{
          
          return false; /*for TDD test purposes, indicator of unsucesful login*/
}
}

  public static function is_valid_user($u){ /*confirms if the userID or adminID is valid one*/
    
    $userid = mysql_real_escape_string($u);
    $query = "SELECT firstname FROM users WHERE id=$userid";
    $result = mysql_query($query) or die(mysql_error());

    
    if(mysql_num_rows($result) == 1){
        return true;
    }else{
        return false;
    }
}
  public static function is_logged_in_student(){ 
      if(isset($_SESSION['dormappid'])) {
			 return true;
      }
      else{
          return false;
   }
}    

  public static function is_logged_in_admin(){ 
      if(isset($_SESSION['dormappadminid'])) {
			 return true;
      }
      else{
          return false;
   }
}   

    
}



?>
