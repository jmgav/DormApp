<!DOCTYPE html>
<?php
require_once 'functions.php';
require_once 'class_application.php';
require_once 'class_login.php';
require_once 'dbconnection.php';

include 'head.php';
include 'logo.php';

dbconnection::getConnection();

$id=$_GET['id'];

if(!login_class::is_logged_in_admin()){
 head(index,'');
  }
  
  else{
  
  
    $userid = mysql_real_escape_string($id);
    $query = "SELECT * FROM applicants WHERE id=$userid";
    $result = mysql_query($query) or die(mysql_error());

    if(mysql_num_rows($result) == 1){
	
	$row = mysql_fetch_assoc($result);
	
	$year=$row['year_level'];
	$income=$row['family_income_annual'];
	$accept=$row['accept_flag'];
	$gender=$row['gender'];
	}
  
  }


?>

 <div class="alert alert-info fade in" data-alert="alert">
      <h3>
        <strong>
         Application for Admission to UPV Dormitories 
        </strong>
		 </h3>
		 	<p class="pull-right"><a href="adminindex" class="btn btn-info">Go back to Admin Panel</a></p>
		 
	<p>Submitted: <?php echo date("l, M d, Y - h:i a",strtotime($row['received_date']));?></p>

	<?php if($accept=='Pending'){ ?>
	<p>Would you like to <a href="#" class="btn btn-success" data-toggle="modal" data-target="#accept">Accept</a> or <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#reject">Reject</a> this Application?</p>
	<?php }
	else if($accept=='Rejected') {
	echo 'This Application is already <b><span class="red">REJECTED</span></b><hr/>';
	?>
	<p>Would you like to <a href="#" class="btn btn-success" data-toggle="modal" data-target="#accept">Accept</a> this application instead? Or put it back on <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#pending">Pending</a> status?</p>
	<?
	}
	else if($accept=='Accepted') {
	echo 'This Application is already <b><span class="green">ACCEPTED</span></b><hr/>';
	?>
	<p>Would you like to <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#reject">Reject</a> this application instead? Or put it back on <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#pending">Pending</a> status?</p>
	<?
	}
	
	?>
	
	
<div class="modal fade" id="accept" tabindex="-1" role="dialog" aria-labelledby="accept-label" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
×
</button>
<h4 class="modal-title" id="newstudents-label">Confirmation</h4>
</div>
<div class="modal-body">
<p>Are you sure you want to ACCEPT this application? This action cannot be undone.</p>

 <a class="btn btn-success" href="accept?id=<?php echo $id;?>">Yes, I am sure</a>

 <a class="btn btn-danger"  data-dismiss="modal" >No, I am not sure. Close</a>
</div>
</div>
</div>
</div>	

<div class="modal fade" id="pending" tabindex="-1" role="dialog" aria-labelledby="accept-label" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
×
</button>
<h4 class="modal-title" id="newstudents-label">Confirmation</h4>
</div>
<div class="modal-body">
<p>Are you sure you want to return this application to PENDING?</p>

 <a class="btn btn-warning" href="pending?id=<?php echo $id;?>">Yes, I am sure</a>

 <a class="btn btn-danger"  data-dismiss="modal" >No, I am not sure. Close</a>
</div>
</div>
</div>
</div>	

<div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="reject-label" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
×
</button>
<h4 class="modal-title" id="newstudents-label">Confirmation</h4>
</div>
<div class="modal-body">
<p>Are you sure you want to REJECT this application?</p>

 <a class="btn btn-warning" href="reject?id=<?php echo $id;?>">Yes, I am sure</a>

 <a class="btn btn-danger"  data-dismiss="modal" >No, I am not sure. Close</a>
</div>
</div>
</div>
</div>	

  </div>
  
 <?php
 if($_SERVER['REQUEST_METHOD']=='POST'){
      
     class_application::submit_edited_app(
		$id,
		trim($_POST['first_name']),
        trim($_POST['last_name']),
		trim($_POST['middle_name']),
		$_POST['gender'],
		trim($_POST['course']),
		trim($_POST['year_level']),
		trim($_POST['units']),
		trim($_POST['mail_address']),
		trim($_POST['landline']),
		$_POST['mobile'],
		trim($_POST['mother_name']),
		trim($_POST['father_name']),
		trim($_POST['mother_address']),
		trim($_POST['father_address']),
		trim($_POST['mother_occupation']),
		trim($_POST['father_occupation']),
		trim($_POST['mother_landline']),
		trim($_POST['mother_mobile']),
		trim($_POST['father_landline']),
		trim($_POST['father_mobile']),
		trim($_POST['guardian_name']),
		trim($_POST['guardian_address']),
		trim($_POST['relationship']),
		trim($_POST['guardian_landline']),
		trim($_POST['guardian_mobile']),
		trim($_POST['remarks'])	
		);    
 }
 ?>
  
  <form action="view?id=<?php echo $id?>" method="post" id="formview"> 
   <div class="row">
   
  <div class="col-sm-3 left">
 <div class="form-group">
 <input type="text" name="remarks" class="form-control input-md" placeholder="Remarks" tabindex="1" value="<?php echo $row['remarks'];?>">
</div>
</div>
 <div class="col-sm-1">

  <input class="btn btn-success" name="commit" type="submit" value="Edit Application">

</div>

</div>
  
 <div class="row">
  <div class="col-md-6">
  <div class="panel panel-info">
    <div class="panel-heading">Student Infomation</div>
    <div class="panel-body">
     
	   	<div class="row">
				<div class="col-sm-6 left">
					<div class="form-group">
                        <input type="text" name="first_name" class="form-control input-md" placeholder="Given Name" tabindex="1" value="<?php echo $row['firstname'];?>">
					</div>
				</div>
				<div class="col-sm-6 right">
					<div class="form-group">
						<input type="text" name="last_name" class="form-control input-md" placeholder="Family Name" tabindex="2" value="<?php echo $row['lastname'];?>">
					</div>
				</div>
			</div>

				<div class="row">
				<div class="col-sm-6 left">
<div class="form-group">
						<input type="text" name="middle_name" class="form-control input-md" placeholder="Middle Name" tabindex="3" value="<?php echo $row['middlename'];?>">
					</div>
					</div>
					
		<div class="col-sm-3 left right">
<div class="form-group">
						<select name="gender" class="form-control input-md" required>
						<option  <?php echo $gender=='male'? 'selected="selected"' : ""; ?> value="male">Male</option>
						<option  <?php echo $gender=='female'? 'selected="selected"' : ""; ?>value="female">Female</option>
						</select>
					</div>
					</div>
					
<div class="col-sm-3 right">
<div class="form-group">
						<input type="text" name="student_number" class="form-control input-md" placeholder="Student Number" tabindex="4" value="<?php echo $row['student_number'];?>" disabled>
					</div>
					</div>
					</div>

<div class="row">
				<div class="col-sm-6 left">
<div class="form-group">
						<input type="text" name="course" class="form-control input-md" placeholder="Course" tabindex="5" value="<?php echo $row['course'];?>">
					</div>
					</div>
<div class="col-sm-3 left right">
<div class="form-group">
						 
					<select name="year_level" class="form-control input-md" tabindex="6">
  <option value='0'>Year Level</option>
  <option <?php echo $year==1? 'selected="selected"' : ""; ?>>1</option>
  <option <?php echo $year==2? 'selected="selected"' : ""; ?>>2</option>
  <option <?php echo $year==3? 'selected="selected"' : ""; ?>>3</option>
  <option <?php echo $year==4? 'selected="selected"' : ""; ?>>4</option>
  <option <?php echo $year==5? 'selected="selected"' : ""; ?>>5</option>
</select>
					</div>
					</div>
					<div class="col-sm-3 right">
					 <div class="form-group">
		<input type="text" name="units" class="form-control input-md" placeholder="Units Enrolled" tabindex="7" value="<?php echo $row['units_enrolled'];?>">
</div>
			</div>		
					</div>
					
 <div class="form-group">
 
		<input type="text" name="perm_address" id="perm" class="form-control input-md" placeholder="Permanent Address" tabindex="8" value="<?php echo $row['perm_address'];?>" disabled>
		
		<input type="hidden" name="home_distance" id="distance" value="<?php echo $row['home_distance'];?>">
		
		</div>

 <div class="form-group">
		<input type="text" name="mail_address" class="form-control input-md" placeholder="Mailing Address" tabindex="9" value="<?php echo $row['mail_address'];?>">
</div>

	<div class="row">
				<div class="col-sm-6 left">
<div class="form-group">
						<input type="text" name="landline" class="form-control input-md" placeholder="Landline no. (with area code)" tabindex="10" value="<?php echo $row['landline'];?>">
					</div>
					</div>
<div class="col-sm-6 right">
<div class="form-group">
						<input type="text" name="mobile" class="form-control input-md" placeholder="Mobile no." tabindex="11" value="<?php echo $row['mobile'];?>">
					</div>
					</div>
					</div>
	  

    </div>
  </div>
  </div>
  
   <div class="col-md-6">
   
     <div class="panel panel-info">
    <div class="panel-heading">Guardians' Information</div>
    <div class="panel-body">
     
  <div class="form-group">
 
 <div class="form-group">
						<input type="text" name="guardian_name" class="form-control input-md" placeholder="Guardians' Name" value="<?php echo $row['guardian_name'];?>">
					</div>

  <div class="form-group">
						<input type="text" name="guardian_address" class="form-control input-md" placeholder="Guardians' Address" value="<?php echo $row['guardian_address'];?>">
					</div>

 <div class="form-group">
						<input type="text" name="relationship" class="form-control input-md" placeholder="Relationship with Applicant" value="<?php echo $row['guardian_relationship'];?>">
					</div>

<div class="row">
				<div class="col-sm-6 left">
<div class="form-group">
						<input type="text" name="guardian_landline" class="form-control input-md" placeholder="Guardians' Landline no." value="<?php echo $row['guardian_landline'];?>">
					</div>
					</div>
<div class="col-sm-6 right">
<div class="form-group">
						<input type="text" name="guardian_mobile" class="form-control input-md" placeholder="Guardians' Mobile no." value="<?php echo $row['guardian_mobile'];?>">
					</div>
					</div>
					</div>
   
   
  </div>


    </div>
  </div>
   
   
</div>
</div>
  
  <div class="row">
    <div class="col-md-6">
  
   <div class="panel panel-info">
    <div class="panel-heading">Mothers' Information</div>
    <div class="panel-body">
     
 <div class="form-group">
						<input type="text" name="mother_name" class="form-control input-md" placeholder="Mothers' Name" value="<?php echo $row['mother_name'];?>">
					</div>
					
 <div class="form-group">
						<input type="text" name="mother_address" class="form-control input-md" placeholder="Mothers' Address" value="<?php echo $row['mother_address'];?>">
					</div>

 <div class="form-group">
						<input type="text" name="mother_occupation" class="form-control input-md" placeholder="Mothers' Occupation" value="<?php echo $row['mother_job'];?>">
					</div>
					
<div class="row">
				<div class="col-sm-6 left">
<div class="form-group">
						<input type="text" name="mother_landline" class="form-control input-md" placeholder="Mothers' Landline no." value="<?php echo $row['mother_landline'];?>">
					</div>
					</div>
<div class="col-sm-6 right">
<div class="form-group">
						<input type="text" name="mother_mobile" class="form-control input-md" placeholder="Mothers' Mobile no." value="<?php echo $row['mother_mobile'];?>">
					</div>
					</div>
					</div>

</div>
</div></div>

  <div class="col-md-6">
 <div class="panel panel-info">
    <div class="panel-heading">Fathers' Information</div>
    <div class="panel-body">
 <div class="form-group">
						<input type="text" name="father_name" class="form-control input-md" placeholder="Fathers' Name" value="<?php echo $row['father_name'];?>">
					</div>
<div class="form-group">
						<input type="text" name="father_address" class="form-control input-md" placeholder="Fathers' Address" value="<?php echo $row['father_address'];?>">
					</div>

 <div class="form-group">
						<input type="text" name="father_occupation" class="form-control input-md" placeholder="Fathers' Occupation" value="<?php echo $row['father_job'];?>">
					</div>
					
<div class="row">
				<div class="col-sm-6 left">
<div class="form-group">
						<input type="text" name="father_landline" class="form-control input-md" placeholder="Fathers' Landline no." value="<?php echo $row['father_landline'];?>">
					</div>
					</div>
<div class="col-sm-6 right">
<div class="form-group">
						<input type="text" name="father_mobile" class="form-control input-md" placeholder="Fathers' Mobile no." value="<?php echo $row['father_mobile'];?>">
					</div>
					</div>
					</div>


</div>
</div>

  



    <div class="panel panel-info">
    <div class="panel-heading">Scholarship and Financial Assistance</div>
    <div class="panel-body">
     

  <div class="form-horizontal">
 

 <div class="form-group">

<label class="col-sm-5 control-label" for="income">Annual Family income: </label>
<div class="col-sm-7">
		<div class="radio">
      <label>
        <?php echo $income==80000? "Below 80,000 (FDS)" : ""; ?>
        <?php echo $income==80001? "80,001-135,000 (FD)" : ""; ?>
		<?php echo $income==135001? "135,001-325,000 (PD80)" : ""; ?>
		<?php echo $income==325001? "325,001-650,000 (PD60)" : ""; ?>
		<?php echo $income==650001? "650,001-1,300,00 (PD40)" : ""; ?>
		<?php echo $income==1300001? "Above 1,300,00 (ND)" : ""; ?>
      </label>
    </div>


    </div>
</div>
   
   
  </div>
  

    </div>
  </div>

</div>
  
  </div>
  
    <div class="row">
  <div class="col-md-10 col-md-offset-1">
  
  <p>Please take note of the following</p>
  <ul>
  
  <li>Pre-calculated points from Home address distance and ST bracket <b>cannot</b> be changed.</li>
  
  <li>Please be mindful about making changes to applications since applicants were reminded to fill-up this form honestly and accurately.</li>
  </ul>
  
  <p>I am fully aware of the changes I am about to do to this application.</p>

		
	
  		
    </div>
  </div>
  
  </form>
  <hr/>

<?php
include 'footer.php';
 ?>
