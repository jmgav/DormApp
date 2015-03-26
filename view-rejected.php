<?php
require_once 'dbconnection.php';
require_once 'class_login.php';
require_once 'functions.php';
include 'head.php';

include 'logo.php';

dbconnection::getConnection();

if(!login_class::is_logged_in_admin()) head(index,'');

	$rejected=0;

	$dorm_name=$_SESSION['dormnameadmin'];
	$query=mysql_query("SELECT * FROM applicants WHERE dorm_name='$dorm_name' and gender='male' and accept_flag='Rejected' ORDER BY points_total DESC")or die(mysql_error());
  

?>


<div class="row">

		 	<p class="pull-right"><a href="adminindex.php" class="btn btn-info">Go back to Admin Panel</a></p>

<ul class="nav nav-tabs" role="tablist" id="myTab">
 <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
  <li role="presentation"><a href="#profilem" aria-controls="profilem" role="tab" data-toggle="tab">Rejected Male Applicants</a></li>
  <li role="presentation"><a href="#profilef" aria-controls="profilef" role="tab" data-toggle="tab">Rejected Female Applicants</a></li>
</ul>

<div class="tab-content">

  <div role="tabpanel" class="tab-pane active" id="home">
  <h4>UPV Dorm Application System - Rejected Applications Panel</h4>
<p>Hello <b><?php echo $_SESSION['firstnameadmin']." ".$_SESSION['lastnameadmin'];?></b></p>

<p>These are the applications you have rejected, you may re-accept these applications.</p>

  
  </div>


  <div role="tabpanel" class="tab-pane" id="profilem">
  
    <h4>Rejected Applications (Male)</h4>
	
<table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th>Name</th>
		  <th>Student Number</th>
          <th>Address</th>
          <th>Mobile number</th>
		  <th>Points</th>
		  <th>Accepted or Rejected</th>
		    
        </tr>
      </thead>
	    <tbody>
	<?php

while ($row = mysql_fetch_assoc($query)) {			

			
echo '<tr class="danger">';
$rejected++;
		
		
		echo '<th>'.'<a href="view?id='.$row['id'].'">'.$row['firstname'].' '.$row['lastname'].'</a></th>';
		echo '<th>'.$row['student_number'].'</th>';
		echo '<th>'.$row['perm_address'].'</th>';
		echo '<th>'.$row['mobile'].'</th>';
		
		echo '<th>'.$row['points_total'].'</th>';
		
echo '<th><span class="red">Rejected</span></th>';
			
		
		echo '</tr>';
		
		}
	?>

      </tbody>
    </table>
<p class="red"><?php echo 'Rejected: '.$rejected;?></p>
	
<p></p>
  
  </div>
  
  <div role="tabpanel" class="tab-pane" id="profilef">
  
    <h4>Rejected Applications (Female)</h4>
	
<table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th>Name</th>
		  <th>Student Number</th>
          <th>Address</th>
          <th>Mobile number</th>
		  <th>Points</th>
		  <th>Accepted or Rejected</th>
		    
        </tr>
      </thead>
	    <tbody>
	<?php

	$rejected=0;

	$dorm_name=$_SESSION['dormnameadmin'];
	$query=mysql_query("SELECT * FROM applicants WHERE dorm_name='$dorm_name' and gender='female' and accept_flag='Rejected' ORDER BY points_total DESC")or die(mysql_error());
  
while ($row = mysql_fetch_assoc($query)) {
		
echo '<tr class="danger">';
 $rejected++;
		
		
		echo '<th>'.'<a href="view.php?id='.$row['id'].'">'.$row['firstname'].' '.$row['lastname'].'</a></th>';
		echo '<th>'.$row['student_number'].'</th>';
		echo '<th>'.$row['perm_address'].'</th>';
		echo '<th>'.$row['mobile'].'</th>';
		
		echo '<th>'.$row['points_total'].'</th>';

 echo '<th><span class="red">Rejected</span></th>';
			
		
		echo '</tr>';
		
		}
	?>

      </tbody>
    </table>

	<p class="red"><?php echo 'Rejected: '.$rejected;?></p>

	
<p></p>
  
  </div>

</div>
</div>


<?  include 'footer.php' ?>