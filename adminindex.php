<?php
require_once 'dbconnection.php';
require_once 'class_login.php';
require_once 'functions.php';
include 'head.php';

include 'logo.php';

dbconnection::getConnection();

if(!login_class::is_logged_in_admin()) head(index,'')


?>


<div class="row">


<ul class="nav nav-tabs" role="tablist" id="myTab">
  <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
  <li role="presentation"><a href="#profilem" aria-controls="profilem" role="tab" data-toggle="tab">View Male Applicants</a></li>
  <li role="presentation"><a href="#profilef" aria-controls="profilef" role="tab" data-toggle="tab">View Female Applicants</a></li>
  <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Other Actions</a></li>
</ul>

<div class="tab-content">
  <div role="tabpanel" class="tab-pane active" id="home">
  <h4>UPV Dorm Application System - Dorm Managers Panel</h4>
<p>Hello <b><?php echo $_SESSION['firstnameadmin']." ".$_SESSION['lastnameadmin'];?></b></p>

<p>Welcome to your control panel</p>



<a href="logout" class="btn btn-primary btn-md active" role="button">Logout</a>
  
  </div>
  <div role="tabpanel" class="tab-pane" id="profilem">
  
    <h4>Pending Applications (Male)</h4>
	
<table class="table table-hover table-bordered tablesorter">
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
	$accepted=0;
	$rejected=0;
	$pending=0;
	$dorm_name=$_SESSION['dormnameadmin'];
	$query=mysql_query("SELECT * FROM applicants WHERE dorm_name='$dorm_name' and gender='male' ORDER BY points_total DESC")or die(mysql_error());
  
while ($row = mysql_fetch_assoc($query)) {
		
		
		if($row['accept_flag']=='Pending') {echo '<tr>'; $pending++;}
				
		else if($row['accept_flag']=='Accepted') {echo '<tr class="success">'; $accepted++;}
			
		else if($row['accept_flag']=='Rejected') {echo '<tr class="danger" style="display:none">'; $rejected++;}
		
		
		echo '<th>'.'<a href="view?id='.$row['id'].'">'.$row['lastname'].', '.$row['firstname'].'</a></th>';
		echo '<th>'.$row['student_number'].'</th>';
		echo '<th>'.$row['perm_address'].'</th>';
		echo '<th>'.$row['mobile'].'</th>';
		
		echo '<th>'.$row['points_total'].'</th>';
		
		if($row['accept_flag']=='Pending') echo '<th><a href="view?id='.$row['id'].'">Pending</a></th>';
				
		else if($row['accept_flag']=='Accepted') echo '<th><span class="green">Accepted</span></th>';
			
		else if($row['accept_flag']=='Rejected') echo '<th><span class="red">Rejected</span></th>';
			
		
		echo '</tr>';
		
		}
	?>

      </tbody>
    </table>
	<p class="green"><?php echo 'Accepted: '.$accepted;?></p>
	<a href="view-rejected"><p class="red"><?php echo 'Rejected: '.$rejected;?></p></a>
	<p><?php echo 'Pending: '.$pending;?></p>
	
<p></p>
  
  </div>
  
  <div role="tabpanel" class="tab-pane" id="profilef">
  
    <h4>Pending Applications (Female)</h4>
	
<table class="table table-hover table-bordered tablesorter">
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
	$accepted=0;
	$rejected=0;
	$pending=0;
	$dorm_name=$_SESSION['dormnameadmin'];
	$query=mysql_query("SELECT * FROM applicants WHERE dorm_name='$dorm_name' and gender='female' ORDER BY points_total DESC")or die(mysql_error());
  
  
  
while ($row = mysql_fetch_assoc($query)) {
		
		
		if($row['accept_flag']=='Pending') {echo '<tr>'; $pending++;}
				
		else if($row['accept_flag']=='Accepted') {echo '<tr class="success">'; $accepted++;}
			
		else if($row['accept_flag']=='Rejected') {echo '<tr class="danger" style="display:none">'; $rejected++;}
		
		
		echo '<th>'.'<a href="view?id='.$row['id'].'">'.$row['lastname'].', '.$row['firstname'].'</a></th>';
		echo '<th>'.$row['student_number'].'</th>';
		echo '<th>'.$row['perm_address'].'</th>';
		echo '<th>'.$row['mobile'].'</th>';
		
		echo '<th>'.$row['points_total'].'</th>';
		
		if($row['accept_flag']=='Pending') echo '<th><a href="view?id='.$row['id'].'">Pending</a></th>';
				
		else if($row['accept_flag']=='Accepted') echo '<th><span class="green">Accepted</span></th>';
			
		else if($row['accept_flag']=='Rejected') echo '<th><span class="red">Rejected</span></th>';
			
		
		echo '</tr>';
		
		}
	?>

      </tbody>
    </table>
	<p class="green"><?php echo 'Accepted: '.$accepted;?></p>
	<a href="view-rejected"><p class="red"><?php echo 'Rejected: '.$rejected;?></p></a>
	<p><?php echo 'Pending: '.$pending;?></p>
	
<p></p>
  
  </div>
  
  
  <div role="tabpanel" class="tab-pane" id="settings">
<?php
	$result2 = mysql_query("SELECT * FROM deadline WHERE date = (SELECT MAX(date) FROM deadline) LIMIT 1") or die(mysql_error());
	
	$deadline = mysql_num_rows($result2);
	
	$row = mysql_fetch_assoc($result2);
	
	$date = date_create($row['date']);
	
	$result3= mysql_query("SELECT * FROM publish WHERE dorm_name='$dorm_name'") or die(mysql_error());
	$published=mysql_num_rows($result3);
	
	if($deadline==0){
?>
  <h4>Open Application Process</h4>
 <p>Do you want to OPEN the application process?</p>
 
  <a href="#" class="btn btn-success" data-toggle="modal" data-target="#open">CONFIRM</a>
  
<?
	}
	else if($deadline>0 && $row['flag']=='open'){
	?>
		<h4>CLOSE APPLICATIONS</h4>
		<p>Applications are currently being accepted.</p> 
		<p>The application process was opened by <b><?echo $row['user'].'</b> on <b>'.date_format($date, 'l\, F d, Y </b>\a\t<b> g:ia');?></b></p>
		
		
		<p>Do you want to END the application process?</p>

		<a href="#" class="btn btn-success" data-toggle="modal" data-target="#confirm">CLOSE</a>
	<?
	}
	
	else if($deadline>0 && $row['flag']=='closed' && $published==0){
	?>
	<h4>CLOSE APPLICATIONS</h4>
	<p>The application process has been closed by <b><?echo $row['user'].'</b> on <b>'.date_format($date, 'l\, F d, Y </b>\a\t<b> g:ia');?></b>.</p>
	<p>Students are unable to submit any more Application Forms.</p>
	<p>Do you want to RE-OPEN the application process?</p>
 
  <a href="#" class="btn btn-success" data-toggle="modal" data-target="#open">RE-OPEN PROCESS</a>
  <hr/>
  <h4>PUBLISH RESULTS</h4>
  <p>Do you want to publish results for <b><?
  echo $_SESSION['dormnameadmin']=='hall1'? 'Balay Lampirong': '';
  echo $_SESSION['dormnameadmin']=='hall2'? 'Balay Kanlaon': '';
  echo $_SESSION['dormnameadmin']=='ilonggo'? 'Balay Ilonggo': '';
  ?></b></p>
   <a href="#" class="btn btn-success" data-toggle="modal" data-target="#publish">PUBLISH MY RESULTS</a>
  
	<?
	}
	else if($published==1){
	?>
	<h4>CLOSE APPLICATIONS</h4>
		<p>The application process has been closed by <b><?echo $row['user'].'</b> on <b>'.date_format($date, 'l\, F d, Y </b>\a\t<b> g:ia');?></b>.</p>
	<p>Students are unable to submit any more Application Forms.</p>
	<p>Do you want to RE-OPEN the application process?</p>
 
  <a href="#" class="btn btn-success" data-toggle="modal" data-target="#open">RE-OPEN PROCESS</a>
  <hr/>
  <h4>PUBLISH RESULTS</h4>
  <p>You have already published the results for <b><?
  echo $_SESSION['dormnameadmin']=='hall1'? 'Balay Lampirong': '';
  echo $_SESSION['dormnameadmin']=='hall2'? 'Balay Kanlaon': '';
  echo $_SESSION['dormnameadmin']=='ilonggo'? 'Balay Ilonggo': '';
  ?></b></p>
  
  <p>You may now <b><a href="print">print the results</a></b></p>

  <p>Congratulations!</p>
  
	
	<?}?>
  
  <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="accept-label" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
×
</button>
<h4 class="modal-title" id="newstudents-label">Confirmation</h4>
</div>
<div class="modal-body">

<p>Are you sure you want to END THE DEADLINE for application? After closing <b>students will no longer be allowed to submit applications.</b></p>
 <a class="btn btn-success" href="confirm">Yes, I am sure</a>
 <a class="btn btn-danger"  data-dismiss="modal" >No, I am not sure. Close</a>

</div>
</div>
</div>
</div>	

  <div class="modal fade" id="open" tabindex="-1" role="dialog" aria-labelledby="accept-label" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
×
</button>
<h4 class="modal-title" id="newstudents-label">Confirmation</h4>
</div>
<div class="modal-body">

<p>Are you sure you want to OPEN the Dorm Application process? <b>Students will then be allowed to submit their application forms.</b></p>
 <a class="btn btn-success" href="openapp">Yes, I am sure</a>
 <a class="btn btn-danger"  data-dismiss="modal" >No, I am not sure. Close</a>

</div>
</div>
</div>
</div>	


  <div class="modal fade" id="publish" tabindex="-1" role="dialog" aria-labelledby="publish-label" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
×
</button>
<h4 class="modal-title" id="newstudents-label">Publish Results</h4>
</div>
<div class="modal-body">

<p>Are you sure you want to publish the results for the dorm application process? Please ensure you have accepted the <b>correct number of applicants.</b></p>
 <a class="btn btn-success" href="publish">Yes, I am sure</a>
 <a class="btn btn-danger"  data-dismiss="modal" >No, I am not sure. Close</a>

</div>
</div>
</div>
</div>	
  
  </div>
</div>
</div>


<?  include 'footer.php' ?>