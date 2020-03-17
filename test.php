<?php
session_start();
include'dbconnection.php';
include'dbconnection.php';
require_once('dbconfig/config.php');
require('vendor/autoload.php');
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
	$query=mysqli_query($con,"INSERT patient set fname='$fname' ,lname='$lname', question1='$question1', question2='$question2', question3='$question3', question4='$question4', datejoined=CURRENT_TIMESTAMP");

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

    		<?php
    		$pid=$_SESSION['pid'];
    		$ret=mysqli_query($con,"select * from patient where id='$pid'");
    	  while($row=mysqli_fetch_array($ret))

    	  {?>
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
            <center><h3><?php echo $row['fname'];?>'s Information</h3></center>

				<div class="inner_container">
                  <div class="col-md-12">
                      <div class="content-panel">


                          <div class="form-group">
                              <label style="padding-left:20px;">First Name </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="lname" value="<?php echo $row['fname'];?>" >
                              </div>
                          </div>

                              <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label" style="padding-left:20px;">Last Name</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="lname" value="<?php echo $row['lname'];?>" >
                              </div>
                          </div>

                               <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label" style="padding-left:20px;">Question 1 </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="question1" value="<?php echo $row['question1'];?>" >
                              </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label" style="padding-left:20px;">Question 2 </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="question2" value="<?php echo $row['question2'];?>" >
                              </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label" style="padding-left:20px;">Question 3 </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="question3" value="<?php echo $row['question3'];?>" >
                              </div>
                          </div>
                            <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label" style="padding-left:20px;">Registration Date </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="regdate" value="<?php echo $row['datejoined'];?>" readonly >
                              </div>
                          </div>
                          <div style="margin-left:100px;">


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

		if($(this).val() == 'Question 4') {
            $('#q4Type').show();
            $('#question4').prop('disabled',false);
        }
        else {
            $('#q4Type').hide();
            $('#question4').prop('disabled',true);
        }
    });
});

  </script>

  </body>
</html>
