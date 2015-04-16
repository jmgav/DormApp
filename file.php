<?php
require_once 'functions.php';
require_once 'class_application.php';
include 'head.php';
include 'logo.php';
?>
<script src="http://maps.google.com/maps?file=api&v=2&key=ABQIAAAA7j_Q-rshuWkc8HyFI4V2HxQYPm-xtd00hTQOC0OXpAMO40FHAxT29dNBGfxqMPq5zwdeiDSHEPL89A" type="text/javascript"></script>
<?php

if(!login_class::is_logged_in_student()) head(index,'');

$id=$_SESSION['student_number'];

    $result = mysql_query("SELECT flag FROM users WHERE student_number='$id'") or die(mysql_error());
    
    if(mysql_num_rows($result) == 1){
	
	$row = mysql_fetch_assoc($result);
	
	$submit_flag=$row['flag'];
	
	}
	
	$result2 = mysql_query("SELECT * FROM deadline WHERE date = (SELECT MAX(date) FROM deadline) LIMIT 1") or die(mysql_error());
	
	$deadline = mysql_num_rows($result2);
	
	$row = mysql_fetch_assoc($result2);
	
	$result3 = mysql_query("SELECT * FROM applicants WHERE student_number='$id'") or die(mysql_error());
	
	$row2 = mysql_fetch_assoc($result3);
	
	$accept_flag=$row2['accept_flag'];
	$confirm_flag=$row2['confirm_flag'];
	
	if($row2['dorm_name']=='hall1'){ 
	$dorm='Balay Lampirong';
	}
	else if($row2['dorm_name']=='hall2'){ 
	$dorm='Balay Kanlaon';
	}
	else if($row2['dorm_name']=='ilonggo'){ 
	$dorm='Balay Ilonggo';
	}
	
	
	
if($submit_flag==0){
	if($deadline>0 && $row['flag']=='open'){
  
		if($_SERVER['REQUEST_METHOD']=='POST' && !empty($_POST['agree'])){
          
		  
     class_application::submit_app(
		$_POST['dormname'],
		trim($_POST['first_name']),
        trim($_POST['last_name']),
		trim($_POST['middle_name']),
		$_POST['gender'],
		$id,
		trim($_POST['course']),
		"1",
		trim($_POST['units']),
		trim($_POST['perm_address']),
		$_POST['home_distance'],
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
		trim($_POST['scholarship']),
		$_POST['income']		
		);    
 }
 
		else if($_SERVER['REQUEST_METHOD']=='POST' && empty($_POST['agree'])){

 echo '<div class="alert alert-danger" role="alert">
  You must Agree to the Terms & Conditions
</div>';
 }
?>

<form action="file" method="post"> 

<div class="alert" data-alert="alert">
      <h3>
        <strong>
         Application for Admission to UPV Dormitories 
        </strong>
      </h3>
	  
	  <a href="logout" class="pull-right"> <button type='button' class='btn btn-danger'>Logout</button></a>
	   <p>Hello Student, please be reminded of the following when filling up this application form.</p>
	   
	  	<p>1. <b>DO NOT leave anything blank</b>, enter "N/A" for fields which are not applicable to you.</p>	  
<p>2. Please enter correct values for each field.</p>
<p>3. Applications that are incorrectly filled up, contain false information, or no valid Guardian information <b>will be discarded.</b></p>
<p>4. All UPV dormitories require a legal Guardian for each of its dormers, if you do not have a Guardian yet, <b>DO NOT CONTINUE</b> with this application.</p>	
	<hr/>
	<p>Please select a dorm to apply for <b>first</b> then continue filling up the application form.</p>
	<p>Balay Ilonggo is located in the UP Iloilo city campus. Balay Kanlaon and Balay Lampirong are both located inside the UP Miag-ao campus.</p>
	<br/>

	 <div class="row">
 
<div class="col-sm-3">
<select class="form-control" name="dormname" id="dormname" required>
<option value="">Select Dorm</option>
<option value="hall1">Balay Lampirong (Hall 1)</option>
<option value="hall2">Balay Kanlaon (Hall 2)</option>
<option value="ilonggo">Balay Ilonggo (UP City Campus)</option>
</select>
 </div>

 </div>
	  
  </div>	
	
<div class="row file-row">
  <div class="col-md-6">
  
  <div class="col-md-12">
  <div class="panel panel-info">
    <div class="panel-heading">Student Infomation</div>
    <div class="panel-body">
      
	 
	   	<div class="row">
				<div class="col-sm-6 left">
					<div class="form-group">
                        <input type="text" name="first_name" class="form-control input-md" placeholder="Given Name" tabindex="1" required>
					</div>
				</div>
				<div class="col-sm-6 right">
					<div class="form-group">
						<input type="text" name="last_name" class="form-control input-md" placeholder="Family Name" tabindex="2"  required>
					</div>
				</div>
			</div>

				<div class="row">
				<div class="col-sm-6 left">
<div class="form-group">
						<input type="text" name="middle_name" class="form-control input-md" placeholder="Middle Name" tabindex="3"  required>
					</div>
					</div>
					
					<div class="col-sm-3 left right">
<div class="form-group">
						<select name="gender" class="form-control input-md" required>
						<option value="">Sex</option>
						<option value="male">Male</option>
						<option value="female">Female</option>
						</select>
					</div>
					</div>
					
					
<div class="col-sm-3 right">
<div class="form-group">
						<input type="text" name="student_number" class="form-control input-md" placeholder="Student Number" tabindex="4" value="<?php echo $id;?>" disabled>
					</div>
					</div>
					</div>

<div class="row">
				<div class="col-sm-9 left">
<div class="form-group">
												

<select name="course" class="form-control input-md" tabindex="5"  required>
<option value="">Course</option>
<option>BS in Accountancy (5 yrs)</option>
<option>BS in Business Administration (Marketing) </option>
<option>BS in Management</option>
<option>BS in Applied Mathematics</option>
<option>BS (Biology)</option>
<option>BS in Chemistry </option>
<option>BA in Communication & Media Studies</option>
<option>BA (Community Development</option>
<option>BS in Computer Science </option>
<option>BS in Economics </option>
<option>BA (History)</option>
<option>BA (Literature)</option>
<option>BA (Political Science)</option>
<option>BA (Psychology)</option>
<option>BS in Public Health</option>
<option>BA (Sociology)</option>
<option>BS in Statistics</option>
<option>BS Fisheries</option>
</select>


					</div>
					</div>

					<div class="col-sm-3 right">
					 <div class="form-group">
		<input type="text" name="units" class="form-control input-md" placeholder="Units Enrolled" tabindex="7" required>
</div>
			</div>		
					</div>
					
 <div class="form-group">
 
		<input type="text" name="perm_address" id="perm" class="form-control input-md" placeholder="Complete Permanent Address" tabindex="8" onkeyup="showLocation(); return false;" autocomplete="off" required>

		<input type="hidden" name="address2" id="address2" value="University of the Philippines Visayas, Miagao, 5023 Iloilo"/>
		
		<br/>
		<div class="alert alert-success" role="alert" id="results"></div>
		<input type="hidden" name="home_distance" id="distance">
		
		<img class="img-responsive pull-right" src="images/gmaps.jpg" style="margin-bottom: 15px" />
		</div>
		
		<script type="text/javascript">
		
		var upv = 'Driving Distance from UP Visayas (Miag-ao): ';
		
		
		jQuery( "#dormname" ).change(function () {
		
		if(jQuery( this ).val()=='ilonggo'){
			jQuery('#address2').val("University of the Philippines in the Visayas, Up Visayas, Molo, Iloilo City, 5000 Iloilo, Philippines");
			upv = 'Driving Distance from UP Visayas (Iloilo City): ';
		}
		else{
			jQuery('#address2').val("University of the Philippines Visayas, Miagao, 5023 Iloilo");
			upv = 'Driving Distance from UP Visayas (Miag-ao): ';
		}
		
		showLocation();
		
		})	
		
		
    var geocoder, location1, location2,gDir;

        geocoder = new GClientGeocoder();
		gDir = new GDirections();

    function showLocation() {
        geocoder.getLocations(jQuery('#perm').val(), function (response) {
            if (!response || response.Status.code != 200)
            {
                
            }
            else
            {
                location1 = {lat: response.Placemark[0].Point.coordinates[1], lon: response.Placemark[0].Point.coordinates[0], address: response.Placemark[0].address};
                geocoder.getLocations(jQuery('#address2').val(), function (response) {
                    if (!response || response.Status.code != 200)
                    {
                       
                    }
                    else
                    {
                        location2 = {lat: response.Placemark[0].Point.coordinates[1], lon: response.Placemark[0].Point.coordinates[0], address: response.Placemark[0].address};
                        calculateDistance();
						
                    }
                });
            }
        });
    }
    
    function calculateDistance()
    {
        try
        {
            var glatlng1 = new GLatLng(location1.lat, location1.lon);
            var glatlng2 = new GLatLng(location2.lat, location2.lon);
            var miledistance = glatlng1.distanceFrom(glatlng2, 3959).toFixed(1);
            var kmdistance = (miledistance * 1.609344).toFixed(1);
			
			gDir.load('from: ' + location1.address + ' to: ' + location2.address);
			var drivingDistanceMiles = (gDir.getDistance().meters / 1609.344).toFixed(1);
            var drivingDistanceKilometers = (gDir.getDistance().meters / 1000).toFixed(1);

            document.getElementById('results').innerHTML = '<strong>General Area: </strong>' + location1.address + '<br/><strong>'+upv+'</strong>' +drivingDistanceMiles+' miles ('+drivingDistanceKilometers+' kilometers)';
			jQuery('#distance').val(drivingDistanceKilometers);
		}
        catch (error)
        {
            alert(error);
        }
    }

    </script>					


 <div class="form-group">
		<input type="text" name="mail_address" class="form-control input-md" placeholder="Mailing Address" tabindex="9"  required>
</div>

	<div class="row">
				<div class="col-sm-6 left">
<div class="form-group">
						<input type="text" name="landline" class="form-control input-md" placeholder="Landline no. (with area code)" tabindex="10"  required>
					</div>
					</div>
<div class="col-sm-6 right">
<div class="form-group">
						<input type="text" name="mobile" class="form-control input-md" placeholder="Mobile no." tabindex="11"  required>
					</div>
					</div>
					</div>
	  

    </div>
  </div>
  </div>
  


 <div class="col-md-12">
    <div class="panel panel-info">
    <div class="panel-heading">Scholarship and Financial Assistance</div>
    <div class="panel-body">
     
  <div class="form-horizontal">
 
 

<div class="form-group">
<label class="col-sm-5 control-label" for="scholarship">Name of Scholarship</label>
<div class="col-sm-7"><input class="form-control" name="scholarship" placeholder="type N/A if none"  required></div>
</div>

 
 <div class="form-group">
 
<label class="col-sm-5 control-label" for="scholarship">Gross Annual Family income</label>
<div class="col-sm-7">
		<div class="radio">
      <label>
        <input type="radio" name="income" value="80000">
          Below 80,000
      </label>
    </div>
	<div class="radio">
      <label>
        <input type="radio" name="income" value="80001">
       80,001-135,000
      </label>
    </div>
	<div class="radio">
      <label>
        <input type="radio" name="income" value="135001">
       135,001-325,000
    </div>
	<div class="radio">
      <label>
        <input type="radio" name="income" value="325001">
        325,001-650,000
      </label>
    </div>
	<div class="radio">
      <label>
        <input type="radio" name="income" value="650001">
      650,001-1,300,00
      </label>
	  </div>
	  <div class="radio">
      <label>
        <input type="radio" name="income" value="1300001" checked>
      Above 1,300,00
      </label>
	  </div>
    </div>
</div>
   
   
  </div>


    </div>
  </div>
  </div>

</div>


    <div class="col-md-6">

    <div class="col-md-12">
  
   <div class="panel panel-info">
    <div class="panel-heading">Mothers' Information</div>
    <div class="panel-body">
     
 <div class="form-group">
						<input type="text" name="mother_name" class="form-control input-md" placeholder="Mothers' Name"  required>
					</div>
					
 <div class="form-group">
						<input type="text" name="mother_address" class="form-control input-md" placeholder="Mothers' Address"  required>
					</div>

 <div class="form-group">
						<input type="text" name="mother_occupation" class="form-control input-md" placeholder="Mothers' Occupation"  required>
					</div>
					
<div class="row">
				<div class="col-sm-6 left">
<div class="form-group">
						<input type="text" name="mother_landline" class="form-control input-md" placeholder="Mothers' Landline no."  required>
					</div>
					</div>
<div class="col-sm-6 right">
<div class="form-group">
						<input type="text" name="mother_mobile" class="form-control input-md" placeholder="Mothers' Mobile no."  required>
					</div>
					</div>
					</div>

</div>
</div>


 <div class="panel panel-info">
    <div class="panel-heading">Fathers' Information</div>
    <div class="panel-body">
 <div class="form-group">
						<input type="text" name="father_name" class="form-control input-md" placeholder="Fathers' Name"  required>
					</div>
<div class="form-group">
						<input type="text" name="father_address" class="form-control input-md" placeholder="Fathers' Address"  required>
					</div>

 <div class="form-group">
						<input type="text" name="father_occupation" class="form-control input-md" placeholder="Fathers' Occupation"  required>
					</div>
					
<div class="row">
				<div class="col-sm-6 left">
<div class="form-group">
						<input type="text" name="father_landline" class="form-control input-md" placeholder="Fathers' Landline no."  required>
					</div>
					</div>
<div class="col-sm-6 right">
<div class="form-group">
						<input type="text" name="father_mobile" class="form-control input-md" placeholder="Fathers' Mobile no."  required>
					</div>
					</div>
					</div>


</div>
</div>
</div>
  
   <div class="col-md-12">
   
     <div class="panel panel-info">
    <div class="panel-heading">Guardians' Information</div>
    <div class="panel-body">
     
  <div class="form-group">
 
 <div class="form-group">
						<input type="text" name="guardian_name" class="form-control input-md" placeholder="Guardians' Name"  required>
					</div>

  <div class="form-group">
						<input type="text" name="guardian_address" class="form-control input-md" placeholder="Guardians' Address"  required>
					</div>

 <div class="form-group">
						<input type="text" name="relationship" class="form-control input-md" placeholder="Relationship with Applicant"  required>
					</div>

<div class="row">
				<div class="col-sm-6 left">
<div class="form-group">
						<input type="text" name="guardian_landline" class="form-control input-md" placeholder="Guardians' Landline no."  required>
					</div>
					</div>
<div class="col-sm-6 right">
<div class="form-group">
						<input type="text" name="guardian_mobile" class="form-control input-md" placeholder="Guardians' Mobile no."  required>
					</div>
					</div>
					</div>
   
   
  </div>


    </div>
  </div>
   
   
</div>
  

  
    </div>
  
  
    
  <script>
  jQuery( "input.form-control" ).each(function(){
	jQuery(this).focusout(function(){
showLocation();
	});
  });
  </script>

  </div>
  <div class="row">
  <div class="col-sm-12">
  <p>Through this Application, I am willing to submit the following document and pay following dorm fees:</p>
  
<p>Lodging Fee : P 1,500.00/semester</p>
<p>P 600.00 or 40% payment is required upon check-in.</p>
<p>Electrical Fees: will be assessed upon issuance of Charge Slips</p>

    <input  name="agree" type="checkbox"  required/>
        <label for="agree">I attest that the information provided above is true and correct.</label> <br/>
		
  <input class="btn btn-success" name="commit" type="submit" value="Submit Application">
  
  		
    </div>
  </div>
  
  </form>
  <hr/>
  <?php
  }  
  else if($deadline==0){ ?>
  <hr/>
  <p>The application process <b>has not been opened yet.</b> Please see the exact dates and login again during that time period.</p>
      
  <a href="logout" class="btn btn-warning">Click this button to logout.</a>
  <?php
  }else{?>
  <hr/>
  <p>We regret to inform you but the <b>deadline has already passed.</b> The dorm application process has now been <b>DISABLED.</b></p>
    
  <p>Please check the homepage for any changes in schedule.</p>
  
  <a href="logout" class="btn btn-warning">Click this button to logout.</a>
  
  <?php 
  }
  }  
  else if($submit_flag==1 && $accept_flag!='Accepted'){
  ?>
  <hr/>
  <p>You have already submitted your application, please wait for the results on the homepage. Results will be posted on <? echo $date_post_results?>.</p>
  
  <p>You may contact the dorm manager of the dorm you have applied for if you have any questions.</p>
  
 <?php additional_instructions($id); ?>
 
 
  
  <a href="logout" class="btn btn-warning">Click this button to logout</a>
  
  <?php }
  
  else if ($submit_flag==1 && $accept_flag=='Accepted' && $confirm_flag=='unconfirmed'){

  ?>
  <hr/>
  <p>Congratulations! Your application has been accepted, you may stay in freshman dorm <b><? echo $dorm ?></b>.</p>
  
  <p>You may confirm your slot by clicking "Confirm" below.</p>
  
  <p>If you do not confirm before the deadline, your slot will automatically be forfeited</p>
  <p>Please make your decision to stay or not to stay in <b><? echo $dorm ?></b> for the upcoming school year.</p>

  <a href="#" class="btn btn-info" data-toggle="modal" data-target="#confirm">CONFIRM</a>
  
  <hr/>
  <a href="logout" class="btn btn-warning">Click this button to logout</a>
  
  
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

<p>Are you sure you want to <b>CONFIRM</b> your slot?</p>

   <a href="confirm_dorm?id=<?php echo $id; ?>" class="btn btn-info">CONFIRM</a>
 <a class="btn btn-danger"  data-dismiss="modal" >No, I am not sure. Close</a>

</div>
</div>
</div>
</div>	

  
  <?php
  }
  else if ($submit_flag==1 && $accept_flag=='Accepted' && $confirm_flag=='confirmed'){
  ?>
   <hr/>
  <p>Congratulations! You have successfully <b>CONFIRMED</b> your slot in freshman dorm <b><?php echo $dorm ?></b>.</p>
  <p>Please check the homepage for announcements on when you can check-in.</p>
  
  <p><b>Check-in Requirements</b></p>
    <ul class="list-unstyled">
<li>a. ReHa forms (download at UPV CRS)</li>
<li>b. Form 5</li>
<li>c. Official Receipt of Dorm Fees</li>
</ul>
  
    <a href="logout" class="btn btn-warning">Logout</a>
<?php
} 
include 'footer.php'; ?>