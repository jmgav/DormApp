<?php
require_once 'dbconnection.php';
require_once 'class_login.php';
require_once 'functions.php';
include 'head.php';
include 'logo.php';

dbconnection::getConnection();

if(!login_class::is_logged_in_admin()) head(index,'');
?>
<script>
jQuery(document).ready(function(){ 
        jQuery(".tablesorter").tablesorter(); 
}); 
</script>

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

<p>Please take note of the following dates</p>

<p>Open application period - <b><?php echo $date_open_application.' - '.$date_close_application;?></b></p>
<p>Deadline for submission of documents - <b><?php echo $date_deadline_requirements;?></b></p>
<p>Posting of results - <b><?php echo $date_post_results;?></b></p>
<p>Confirmation period - <b><?php echo $date_confirmation_start.' - '.$date_confirmation_end;?></b></p>

<a href="logout" class="btn btn-primary btn-md active" role="button">Logout</a>
  
  </div>
  <div role="tabpanel" class="tab-pane" id="profilem">
  	
<?php
	$dorm_name=$_SESSION['dormnameadmin'];
	$query_accepted=mysql_query("SELECT COUNT(accept_flag) FROM applicants WHERE accept_flag='Accepted' and gender='male' and dorm_name='$dorm_name'")or die(mysql_error());
	$query_rejected=mysql_query("SELECT COUNT(accept_flag) FROM applicants WHERE accept_flag='Rejected' and gender='male' and dorm_name='$dorm_name'")or die(mysql_error());
	$query_pending=mysql_query("SELECT COUNT(accept_flag) FROM applicants WHERE accept_flag='Pending' and gender='male' and dorm_name='$dorm_name'")or die(mysql_error());

	$accepted=mysql_result($query_accepted, 0);
	$rejected=mysql_result($query_rejected, 0);
	$pending=mysql_result($query_pending, 0);
  ?>
		
	<div class="row applicants">
	<div class="col-sm-2"><h4>Male Applicants</h4></div>
	<div class="col-sm-2 col-sm-offset-4"><h4 class="green"><?php echo 'Accepted: '.$accepted;?></h4></div>
	<div class="col-sm-2"><h4 class="red"><a href="view-rejected"><?php echo 'Rejected: '.$rejected;?></a></h4></div>
	<div class="col-sm-2"><h4><?php echo 'Pending: '.$pending;?></h4></div>
	</div>
	
<table class="table table-hover table-bordered tablesorter">
      <thead>
        <tr>
          <th class="col-sm-3">Name</th>
		  <th class="col-sm-1">Student No.</th>
          <th class="col-sm-2">Address</th>
          <th class="col-sm-2">Mobile No.</th>
		  <th class="col-sm-1">Points</th>
		  <th class="col-sm-1">Status</th>
		  <th class="col-sm-2">Remarks</th>
		    
        </tr>
      </thead>
	    <tbody>
<?php
	$query=mysql_query("SELECT * FROM applicants WHERE dorm_name='$dorm_name' and gender='male' ORDER BY points_total DESC")or die(mysql_error());
  
while ($row = mysql_fetch_assoc($query)) {
		
		if($row['confirm_flag']=='confirmed'){
		$confirm='(C)';
		}
		else{
		$confirm='(N)';
		}
		
		if($row['accept_flag']=='Pending') {echo '<tr>'; $pending++;}
				
		else if($row['accept_flag']=='Accepted') {echo '<tr class="success">'; $accepted++;}
			
		else if($row['accept_flag']=='Rejected') {echo '<tr class="danger" style="display:none">'; $rejected++;}
		
		
		echo '<th>'.'<a href="view?id='.$row['id'].'">'.$row['lastname'].', '.$row['firstname'].'</a></th>';
		echo '<th>'.$row['student_number'].'</th>';
		echo '<th>'.$row['perm_address'].'</th>';
		echo '<th>'.$row['mobile'].'</th>';
		
		echo '<th>'.$row['points_total'].'</th>';
		
		if($row['accept_flag']=='Pending') echo '<th><a href="view?id='.$row['id'].'">Pending</a></th>';
				
		else if($row['accept_flag']=='Accepted') echo '<th><span class="green">Accepted '.$confirm.'</span></th>';
			
		else if($row['accept_flag']=='Rejected') echo '<th><span class="red">Rejected</span></th>';
			
		echo '<th>'.$row['remarks'].'</th>';
		
		echo '</tr>';
		
		}
?>

      </tbody>
    </table>	
<p></p>
  
  </div>
  
  <div role="tabpanel" class="tab-pane" id="profilef">
  
<?php
	$dorm_name=$_SESSION['dormnameadmin'];
	$query=mysql_query("SELECT * FROM applicants WHERE dorm_name='$dorm_name' and gender='female' ORDER BY points_total DESC")or die(mysql_error());
  
  $query_acceptedf=mysql_query("SELECT COUNT(accept_flag) FROM applicants WHERE accept_flag='Accepted' and gender='female' and dorm_name='$dorm_name'")or die(mysql_error());
	$query_rejectedf=mysql_query("SELECT COUNT(accept_flag) FROM applicants WHERE accept_flag='Rejected' and gender='female' and dorm_name='$dorm_name'")or die(mysql_error());
	$query_pendingf=mysql_query("SELECT COUNT(accept_flag) FROM applicants WHERE accept_flag='Pending' and gender='female' and dorm_name='$dorm_name'")or die(mysql_error());

	$acceptedf=mysql_result($query_acceptedf, 0);
	$rejectedf=mysql_result($query_rejectedf, 0);
	$pendingf=mysql_result($query_pendingf, 0);
?>
	<div class="row applicants">
	<div class="col-sm-2"><h4>Female Applicants</h4></div>
	<div class="col-sm-2 col-sm-offset-4"><h4 class="green"><?php echo 'Accepted: '.$acceptedf;?></h4></div>
	<div class="col-sm-2"><h4 class="red"><a href="view-rejected"><?php echo 'Rejected: '.$rejectedf;?></a></h4></div>
	<div class="col-sm-2"><h4><?php echo 'Pending: '.$pendingf;?></h4></div>
	</div>
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
while ($row = mysql_fetch_assoc($query)) {
		
		
		if($row['accept_flag']=='Pending') {echo '<tr>';}
				
		else if($row['accept_flag']=='Accepted') {echo '<tr class="success">';}
			
		else if($row['accept_flag']=='Rejected') {echo '<tr class="danger" style="display:none">';}
		
		
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

<p></p>
  
  </div>
  
  
  <div role="tabpanel" class="tab-pane" id="settings">
<?php

date_default_timezone_set('Asia/Manila');

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
  
<?php
} else if($deadline>0 && $row['flag']=='open'){
?>
		<h4>CLOSE APPLICATIONS</h4>
		<p>Applications are currently being accepted.</p> 
		<p>The application process was opened by <b><?php echo $row['user'].'</b> on <b>'.date_format($date, 'l\, F d, Y </b>\a\t<b> g:ia');?></b></p>
		
		
		<p>Do you want to END the application process?</p>

		<a href="#" class="btn btn-success" data-toggle="modal" data-target="#confirm">CLOSE</a>
<?php
} else if($deadline>0 && $row['flag']=='closed' && $published==0){
?>
	<h4>CLOSE APPLICATIONS</h4>
	<p>The application process has been closed by <b><?php echo $row['user'].'</b> on <b>'.date_format($date, 'l\, F d, Y </b>\a\t<b> g:ia');?></b>.</p>
	<p>Students are unable to submit any more Application Forms.</p>
	<p>Do you want to RE-OPEN the application process?</p>
 
  <a href="#" class="btn btn-success" data-toggle="modal" data-target="#open">RE-OPEN PROCESS</a>
  <hr/>
  <h4>PUBLISH RESULTS</h4>
  <p>Do you want to publish results for <b><?php
  echo $_SESSION['dormnameadmin']=='hall1'? 'Balay Lampirong': '';
  echo $_SESSION['dormnameadmin']=='hall2'? 'Balay Kanlaon': '';
  echo $_SESSION['dormnameadmin']=='ilonggo'? 'Balay Ilonggo': '';
?></b></p>
   <a href="#" class="btn btn-success" data-toggle="modal" data-target="#publish">PUBLISH MY RESULTS</a>
  
<?php
} else if($published==1){
?>
	<h4>CLOSE APPLICATIONS</h4>
		<p>The application process has been closed by <b><?php echo $row['user'].'</b> on <b>'.date_format($date, 'l\, F d, Y </b>\a\t<b> g:ia');?></b>.</p>
	<p>Students are unable to submit any more Application Forms.</p>
	<p>Do you want to RE-OPEN the application process?</p>
 
  <a href="#" class="btn btn-success" data-toggle="modal" data-target="#open">RE-OPEN PROCESS</a>
  <hr/>
  <h4>PUBLISH RESULTS</h4>
  <p>You have already published the results for <b>\
<?php
  echo $_SESSION['dormnameadmin']=='hall1'? 'Balay Lampirong': '';
  echo $_SESSION['dormnameadmin']=='hall2'? 'Balay Kanlaon': '';
  echo $_SESSION['dormnameadmin']=='ilonggo'? 'Balay Ilonggo': '';
?></b></p>
  
  <p>You may now <b><a href="print" target="_blank">print the results.</a></b></p>
  <p>Click the link, then press CTRL + P to print.</p>

  <p>Congratulations!</p>
  
	
<?php } ?>
  
  <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="accept-label" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
�
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
�
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
�
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


<?php

include 'footer.php'; ?>