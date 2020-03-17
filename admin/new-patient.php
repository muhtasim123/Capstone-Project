<?php
session_start();
include'dbconnection.php';
//Checking session is valid or not


// for updating user info
if(isset($_POST['submit']))
{
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$question1=$_POST['question1'];
	$question2=$_POST['question2'];
	$question3=$_POST['question3'];
	$question4=$_POST['question4'];
	$query=mysqli_query($con,"INSERT patient set fname='$fname' ,lname='$lname', question1='$question1', question2='$question2', question3='$question3', datejoined=CURRENT_TIMESTAMP");

	if($query)
		{
		echo "<script>alert('Patient Added');</script>";
		}
}
?>

<!DOCTYPE html>
  <head>
<html lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Admin | Create Profile</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
  </head>

  <body>

  <section id="container" >
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <a href="#" class="logo"><b>Staff Dashboard</b></a>
            <div class="nav notify-row" id="top_menu">



                </ul>
            </div>
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="logout.php">Logout</a></li>
            	</ul>
            </div>
        </header>
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <ul class="sidebar-menu" id="nav-accordion">

              	  <p class="centered"><a href="#"><img src="assets/img/logo100.png" class="img-circle" width="100"></a></p>
              	  <h5 class="centered"><?php echo $_SESSION['login'];?></h5>

                  <li class="mt">
                      <a href="change-password.php">
                          <i class="fa fa-file"></i>
                          <span>Change Password</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="manage-patients.php" >
                          <i class="fa fa-users"></i>
                          <span>Manage Patients</span>
                      </a>

                  </li>
				  
				   <li class="sub-menu">
                      <a href="new-staff.php" >
                          <i class="fa fa-users"></i>
                          <span>Add Staff</span>
                      </a>

                  </li>
				  
				  <li class="sub-menu">
                      <a href="new-caregiver.php" >
                          <i class="fa fa-users"></i>
                          <span>Add Caregiver</span>
                      </a>

                  </li>


              </ul>
          </div>
      </aside>

      <section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> New Patient's Information</h3>

				<div class="row">



                  <div class="col-md-12">
                      <div class="content-panel">
                      <p align="center" style="color:#F00;"><?php echo $_SESSION['msg'];?><?php echo $_SESSION['msg']=""; ?></p>
                           <form class="form-horizontal style-form" name="form1" method="post" action="" onSubmit="return valid();">
                           <p style="color:#F00"><?php echo $_SESSION['msg'];?><?php echo $_SESSION['msg']="";?></p>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">First Name </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="fname"  >
                              </div>
                          </div>

                              <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Last Name</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="lname"  >
                              </div>
                          </div>

                               <div class="form-group">
                              <div class="col-sm-2 col-sm-2 control-label">
    <select class="form-control" name="qp_type" id="p_type" required>
        <option  value="Question 1">Question 1</option>
        <option  value="Question 2">Question 2</option>
		<option  value="Question 3">Question 3</option>
    </select>
    </div>

			<div class="form-group" id="q1Type">
			<div class="col-sm-10">
				<input id="question1" type="text" class="form-control" name="qp_type">
				</div>
			</div>

			<div class="form-group" id="q2Type" style="display:none;">
			<div class="col-sm-10">
				<input id="question2" type="text" class="form-control" name="qp_type">
			</div>
			</div>

			<div class="form-group" id="q3Type" style="display:none;">
			<div class="col-sm-10">
				<input id="question3" type="text" class="form-control" name="qp_type">
			</div>
			</div>

                          </div>
                          <div style="margin-left:100px;">
                          <input type="submit" name="submit" value="Add" class="btn btn-theme"></div>
                          </form>
                      </div>
                  </div>
              </div>
		</section>
      </section></section>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/common-scripts.js"></script>
  <script>
   $(document).ready(function(){
    $('select[name=qp_type]').change(function(){
        if($(this).val() == 'Question 1') {
            $('#q1Type').show();
            $('#question1').prop('disabled',false);
        }
        else {
            $('#q1Type').hide();
            $('#question1').prop('disabled',true);
        }
		
		if($(this).val() == 'Question 2') {
            $('#q2Type').show();
            $('#question2').prop('disabled',false);
        }
        else {
            $('#q2Type').hide();
            $('#question2').prop('disabled',true);
        }
		
		if($(this).val() == 'Question 3') {
            $('#q3Type').show();
            $('#question3').prop('disabled',false);
        }
        else {
            $('#q3Type').hide();
            $('#question3').prop('disabled',true);
        }
		
    });
});

  </script>

  </body>
</html>
