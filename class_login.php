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
 
public static function login($username,$password){ /*funtion to login*/

$result=mysql_query("SELECT * FROM users WHERE username='$username' AND password=md5('$password')")or die(mysql_error());
  
if(mysql_num_rows($result) == 1){ /*if a users login information is found in the database, sets the SESSION variables*/
        $row = mysql_fetch_assoc($result);
        $_SESSION['dormappid'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        
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
  public static function is_logged_in(){ /*function to check if someone is logged in, either as a normal user or an admin*/

      if(isset($_SESSION['dormappid'])) {
			 return true;
      }
      else{
          return false;
   }
}    
    
}



?>
