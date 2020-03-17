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
    <link href="admin/assets/css/bootstrap.css" rel="stylesheet">
    <link href="admin/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="admin/assets/css/style.css" rel="stylesheet">
    <link href="admin/assets/css/style-responsive.css" rel="stylesheet">
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

              	  <p class="centered"><a href="#"><img src="admin/assets/img/logo100.png" class="img-circle" width="100"></a></p>
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
        <div class="row">
          <div class="col-md-12">
              <div class="content-panel">
        <form enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']?>" method="POST" style="padding-left:1%; margin-top:-3.5% padding-bottom: 1%"><br><br>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['userfile']) && $_FILES['userfile']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['userfile']['tmp_name'])) {
// FIXME: add more validation, e.g. using ext/fileinfo
try {
// FIXME: do not use 'name' for upload (that's the original filename from the user's computer)
$upload = $s3->upload($bucket, $_FILES['userfile']['name'], fopen($_FILES['userfile']['tmp_name'], 'rb'), 'public-read');
?>
<input type="hidden" name="link" value="<?=htmlspecialchars($upload->get('ObjectURL'))?>">
<input type="hidden" name="mediaid" value="<?php echo $row['mediaid'];?>">

<?php } catch(Exception $e) { ?>
<p>Upload error :(</p>
<?php } } ?>
<h3><i class="fa fa-angle-right"></i>Upload</h3>

<label for="album">Album Name:</label>
<input type="text" id="album" name="album"><br><br>
  <input name="userfile" type="file"><br><br>
    <input type="submit" value="Upload">
</form>
</div></div>
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

$(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>
</html>
