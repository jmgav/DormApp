<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

require 'functions.php';
require 'class_login.php';
include 'head.php';
include 'logo.php';
?>
<div class="row">

<div class="col-sm-9">
<ul class="nav nav-tabs" role="tablist" id="myTab">
  <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
  <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">How Do I Apply?</a></li>
  <!--
  <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Helpdesk</a></li>
  -->
</ul>

<div class="tab-content">
  <div role="tabpanel" class="tab-pane active fade in" id="home">
  <br/>
  <h4>Welcome to the UPV online dormitory application system </h4>
  <p>Incoming freshmen may login using the form on the right</p>
  <hr/>
  <h4>Login Instructions</h4>
  <p>All students who wish to apply for a UPV dorm will login using the E-mail address they used in applying for the UPCAT. Your temporary password is your student number (201xxxxx).</p>
  <p>If you do not have one yet, please contact the CRS office at (033) 315-8556 local 190 for account activation.</p>

<?php
$query=mysql_query("SELECT * FROM publish WHERE dorm_name='hall1'")or die(mysql_error());
  
while ($row = mysql_fetch_assoc($query)) {
?>
<hr/>
<h4>Final list of accepted applicants for UPV dorm <b>Balay Lampirong (Hall1)</b></h4>
<table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th><b>Name</b></th>
		  <th><b>Student Number</b></th>   
        </tr>
      </thead>
	    <tbody>
<?php
$query2=mysql_query("SELECT * FROM applicants WHERE dorm_name='hall1' AND accept_flag='Accepted'")or die(mysql_error());
while ($row2 = mysql_fetch_assoc($query2)) {
echo '<tr>';
echo '<th>'.$row2['firstname'].' '.$row2['lastname'].'</th>';
		echo '<th>'.$row2['student_number'].'</th>';

echo '</tr>';
}
echo '</tbody>
    </table>';
}

$query=mysql_query("SELECT * FROM publish WHERE dorm_name='hall2'")or die(mysql_error());
  
while ($row = mysql_fetch_assoc($query)) {
?>
<hr/>
<h4>Final list of accepted applicants for UPV dorm <b>Balay Kanlaon (Hall2)</b></h4>

<table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th><b>Name</b></th>
		  <th><b>Student Number</b></th>  
        </tr>
      </thead>
	    <tbody>
<?php
$query2=mysql_query("SELECT * FROM applicants WHERE dorm_name='hall2' AND accept_flag='Accepted'")or die(mysql_error());
while ($row2 = mysql_fetch_assoc($query2)) {
echo '<tr>';
echo '<th>'.$row2['firstname'].' '.$row2['lastname'].'</th>';
		echo '<th>'.$row2['student_number'].'</th>';
echo '</tr>';
}
echo '</tbody>
    </table>';
}

$query=mysql_query("SELECT * FROM publish WHERE dorm_name='ilonggo'")or die(mysql_error());
  
while ($row = mysql_fetch_assoc($query)) {
?>
<hr/>
<h4>Final list of accepted applicants for UPV dorm <b>Balay Ilonggo (UP City Campus)</b></h4>
<table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th><b>Name</b></th>
		  <th><b>Student Number</b></th>      	    
        </tr>
      </thead>
	    <tbody>
<?php
$query2=mysql_query("SELECT * FROM applicants WHERE dorm_name='ilonggo' AND accept_flag='Accepted'")or die(mysql_error());
while ($row2 = mysql_fetch_assoc($query2)) {
echo '<tr>';
echo '<th>'.$row2['firstname'].' '.$row2['lastname'].'</th>';
		echo '<th>'.$row2['student_number'].'</th>';
echo '</tr>';
}
echo '</tbody></table>';
}
?>
  </div>
  <div role="tabpanel" class="tab-pane fade" id="messages">
  <h4>Who can apply</h4>

<p>To qualify for the dormitory application, the student must:
Be a Filipino*;
Be a bonafide undergraduate student; Except for students pursuing a Master Degree;
Never have been adjudged guilty of any offense that carries a penalty of more than 30 days suspension;
Never have received a memo 2 violation from the previous evaluation; and
Have remaining tenure for the dormitory.</p>

<hr/>

<h4>Terms and conditions before applying for the dormitory.</h4>

<p>The University reserves the right to determine whether the student deserves to be accepted in the dormitory. The Dormitory Managers, in coordination with the Offices of Student Affairs (OSAs), will organize a fact-finding team to check information submitted by the applicants. Dormitory privileges may be withdrawn when a student withholds or gives false information, without prejudice to other penalties that may be imposed by the University.</p>
<p>All information supplied in the application will be kept secure and confidential. All information may be used by the University for research, with the assurance that personal details of the applicant will be kept secure.</p>
  </div>
  <div role="tabpanel" class="tab-pane" id="settings">
  <div class="table-responsive">
  <table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th>Dormitory</th>
          <th>Head of Office</th>
          <th>Email Address</th>
          <th>Contact Numbers</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Lampirong</td>
          <td>Aster Tronco</td>
          <td>hallone@gmail.com</td>
          <td>221</td>
        </tr>
		 <tr>
          <td>Kanlaon</td>
          <td>Divina Punongbayan</td>
          <td>BKstrong2@yahoo.com</td>
          <td>129</td>
        </tr>
		 <tr>
          <td>Gumamela</td>
          <td>Susana Triunfante</td>
          <td>BestDorm@gmail.com</td>
          <td>225</td>
        </tr>
        <tr>
          <td>Madyaas</td>
          <td>Someone</td>
          <td>BoysDorm@gmail.com</td>
           <td>226</td>
        </tr>
        <tr>
          <td>Apitong</td>
          <td>Nida Belas</td>
          <td>UPVGrad@yahoo.com</td>
		   <td>222</td>
        </tr>
		<tr>
          <td>Illonggo</td>
          <td>Princess Sarah</td>
          <td>c1typ3opl3@outlook.com</td>
		   <td>33010231</td>
        </tr>
      </tbody>
    </table>
	</div>
  
  </div>
</div>

</div>

<div class="col-sm-3">
 
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title">Student Login</h3>
</div>
<div class="panel-body">
<form action="index" method="post" accept-charset="utf-8">
<p><a href="#" data-toggle="modal" data-target="#newstudents"><span>Where can I get my password?</span></a></p>

<div class="form-group">
<input type="text" class="form-control" name="username" placeholder="E-mail" value="" autocomplete="off" maxlength="64">
</div>
<div class="form-group">
<input type="password" class="form-control" name="password" placeholder="Password" maxlength="20" value="">
</div>

<p><button type="submit" class="btn btn-success">
Log in
</button></p>

<?php 
if($_SERVER['REQUEST_METHOD']=='POST'){  

if(login_class::login($_POST['username'],$_POST['password'])=='file' && login_class::is_logged_in_student()){
       head(file,'');
    }
	else if(login_class::login($_POST['username'],$_POST['password'])=='reset'){
		head(reset,'');
	}
    else{
        echo "<div class='alert alert-danger' role='alert'>Wrong Username or Password!</div>"; /*unsecesfull login displays error message*/
    }
 }

 ?> 

</form> <small><strong class="text-info">Forgot your password?</strong> Contact the CRS office in old admin.</small>
</div>
</div>

<div class="modal fade" id="newstudents" tabindex="-1" role="dialog" aria-labelledby="newstudents-label" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
×
</button>
<h4 class="modal-title" id="newstudents-label">What is my login password?</h4>
</div>
<div class="modal-body">
<p>All students who wish to apply for a UPV dorm will login using the <strong class="text-info">E-mail address</strong> they used in applying for the UPCAT. Your temporary password is your <b>student number (201xxxxx).</b></p>

<p>
If you do not have one yet, please contact the CRS office for account activation.
</p>
</div>
</div>
</div>
</div>


</div>


</div>

<?php include 'footer.php'; ?>
