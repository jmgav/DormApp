<!DOCTYPE html>
<?php
require_once 'functions.php';
include 'head.php';
require_once 'class_login.php';

include 'logo.php';
?>


<div class="row">

<div class="col-sm-9">
<ul class="nav nav-tabs" role="tablist" id="myTab">
  <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
  <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Announcements</a></li>
  <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">How Do I Apply?</a></li>
  <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Helpdesk</a></li>
</ul>

<div class="tab-content">
  <div role="tabpanel" class="tab-pane active" id="home">
  <h4>UPV Dorm Application System</h4>
<p>You will find relevant stuff here, including an introduction of the system and its purpose.</p>

<?php
$query=mysql_query("SELECT * FROM deadline")or die(mysql_error());
  
while ($row = mysql_fetch_assoc($query)) {

if($row['flag']==1){

echo '<h4>Here are the accepted applicants for UPV dorms</h4>';

echo '<table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th>Name</th>
		  <th>Student Number</th>
          <th>Address</th>
      
		    
        </tr>
      </thead>
	    <tbody>';

$query2=mysql_query("SELECT * FROM applicants WHERE accept_flag='Accepted'")or die(mysql_error());
while ($row2 = mysql_fetch_assoc($query2)) {
echo '<tr>';
echo '<th>'.$row2['firstname'].' '.$row2['lastname'].'</th>';
		echo '<th>'.$row2['student_number'].'</th>';
		echo '<th>'.$row2['perm_address'].'</th>';

echo '</tr>';

}

echo '</tbody>
    </table>';

}

}
?>

  
  </div>
  <div role="tabpanel" class="tab-pane" id="profile">
  
    <h4>Application and Interview Period for the Second Semester</h4>

<p>To accommodate the rest of the dormitory applicants, DAS Online will follow the schedules on the following dates:</p>

<h4>SCHEDULE</h4>

<table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th>Dormitory</th>
          <th>Applications</th>
          <th>Results</th>
          <th>Interview</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Lampirong</td>
          <td>November 17-19</td>
          <td>December 5</td>
          <td>December 10</td>
        </tr>
		 <tr>
          <td>Kanlaon</td>
          <td>November 19-21</td>
          <td>December 7</td>
          <td>December 10</td>
        </tr>
		 <tr>
          <td>Gumamela</td>
          <td>November 17-19</td>
          <td>December 5</td>
          <td>December 10</td>
        </tr>
        <tr>
          <td>Madyaas</td>
          <td>November 19-21</td>
          <td>December 7</td>
           <td>December 10</td>
        </tr>
        <tr>
          <td>Apitong</td>
          <td>November 17-19</td>
          <td>December 5</td>
		   <td>December 10</td>
        </tr>
		<tr>
          <td>Illonggo</td>
          <td>November 18-20</td>
          <td>December 6</td>
		   <td>December 10</td>
        </tr>
      </tbody>
    </table>

<p>For inquires, please contact the respective dormitory your will apply for. Check out the DAS Helpdesk tab for contact details.</p>
  
  </div>
  <div role="tabpanel" class="tab-pane" id="messages">
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
<form action="index.php" method="post" accept-charset="utf-8">
<p><a href="#" data-toggle="modal" data-target="#newstudents"><span>Where can I get my password?</span></a></p>

<div class="form-group">
<input type="text" class="form-control" name="username" placeholder="Student No. 20xxxxxxx" value="" autocomplete="off" maxlength="10">
</div>
<div class="form-group">
<input type="password" class="form-control" name="password" placeholder="Password" maxlength="20" value="">
</div>

<p><button type="submit" class="btn btn-success">
Log in
</button></p>

  <?php 
if($_SERVER['REQUEST_METHOD']=='POST'){  

login_class::login($_POST['username'],$_POST['password']); /*login function*/
 
    if(login_class::is_logged_in_student()){
       head(file,'');
    }
    else{
        echo "<button type='button' class='btn btn-danger' id='wronglogin'>Wrong Username or Password!</button>"; /*unsecesfull login displays error message*/
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
<p>All students who wish to apply for a UP dorm will login <strong class="text-info">using the same login credentials used in the CRS</strong> to access the dorm application form.</p>

<p>
If you do not have one yet, contact the CRS office for your temporary password.
</p>
</div>
</div>
</div>
</div>


</div>


</div>

 

  <?
  include 'footer.php'
?>
