<!DOCTYPE html>
<?php
require_once 'functions.php';
include 'head.php';
require_once 'class_login.php';


dbconnection::getConnection();

if(!login_class::is_logged_in_admin()) head(index,'');

$dorm_name=$_SESSION['dormnameadmin'];

$query=mysql_query("SELECT * FROM publish WHERE dorm_name='$dorm_name'")or die(mysql_error());
  
while ($row = mysql_fetch_assoc($query)) {

echo '<h4><center>Final list of dormers for <b>';
  echo $dorm_name=='hall1'? 'Balay Lampirong': '';
  echo $dorm_name=='hall2'? 'Balay Kanlaon': '';
  echo $dorm_name=='ilonggo'? 'Balay Ilonggo': '';
echo '</b></center></h4>';

echo '<table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th class="col-xs-6"><b>Name</b></th>
		  <th class="col-xs-2"><b>Student Number</b></th>
		  <th class="col-xs-4"><b>Course</b></th>
    
        </tr>
      </thead>
	    <tbody>';

$query2=mysql_query("SELECT * FROM applicants WHERE dorm_name='$dorm_name' AND accept_flag='Accepted'")or die(mysql_error());
while ($row2 = mysql_fetch_assoc($query2)) {
echo '<tr>';
echo '<th>'.$row2['lastname'].', '.$row2['firstname'].'</th>';
echo '<th>'.$row2['student_number'].'</th>';
echo '<th>'.$row2['course'].'</th>';
echo '</tr>';

}

echo '</tbody>
    </table>';
}


?>
