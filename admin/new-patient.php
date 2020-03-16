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

                               <div class="form-group"  id="dynamic_field">
                              <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Question 1 </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="question" value="question1" >
								  <input type="text" class="form-control" name="answer" value="answer1" >
                              </div>
                          </div>
                          <div style="margin-left:100px;">
						  <button type="button" name="add" id="add" class="btn btn-success">Add More Questions</button>
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
      var i=1;  
      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Question '+i+'</label><div class="col-sm-10"><input type="text" class="form-control" name="question" placeholder="question'+i+'" ><input type="text" class="form-control" name="answer" placeholder="answer '+i+'"></div>');	   
      });   
 });  
      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>
</html>
