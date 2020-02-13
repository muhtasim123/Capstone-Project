<?php
	session_start();
	require_once('dbconfig/config.php');
	//phpinfo();
	$msg = "";

  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
		// Get image name
  	$image = $_FILES['image']['name'];
  	// Get text
  	$image_text = mysqli_real_escape_string($con, $_POST['text']);

  	// image file directory
  	$target = "images/".basename($image);

  	$sql = "INSERT INTO images (id, image, text) VALUES ('$id','$image', '$image_text')";
  	// execute query
  	mysqli_query($con, $sql);

  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
  }
  $result = mysqli_query($con, "SELECT * FROM images");
?>
<!DOCTYPE html>
<html>
<head>
<title>Home Page</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div id="main-wrapper">
		<center><h2>Home Page</h2></center>
		<center><h3>Welcome <?php echo $_SESSION['name']; ?></h3></center>
<?php $ret=mysqli_query($con,"select * from patient where id='".$_GET['uid']."'");
	  while($row=mysqli_fetch_array($ret))
	  
	  {?>
      <section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> <?php echo $row['fname'];?>'s Information</h3>
             	
				<div class="row">
				
                  
	                  
                  <div class="col-md-12">
                      <div class="content-panel">
                      <p align="center" style="color:#F00;"><?php echo $_SESSION['msg'];?><?php echo $_SESSION['msg']=""; ?></p>
                           <form class="form-horizontal style-form" name="form1" method="post" action="" onSubmit="return valid();">
                           <p style="color:#F00"><?php echo $_SESSION['msg'];?><?php echo $_SESSION['msg']="";?></p>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">First Name </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="fname" value="<?php echo $row['fname'];?>" >
                              </div>
                          </div>
                          
                              <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Last Ename</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="lname" value="<?php echo $row['lname'];?>" >
                              </div>
                          </div>
                          
                               <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Question 1 </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="question1" value="<?php echo $row['question1'];?>" >
                              </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Question 2 </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="question2" value="<?php echo $row['question2'];?>" >
                              </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Question 3 </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="question3" value="<?php echo $row['question3'];?>" >
                              </div>
                          </div>
                            <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Registration Date </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="regdate" value="<?php echo $row['datejoined'];?>" readonly >
                              </div>
                          </div>
                          <div style="margin-left:100px;">
                          <input type="submit" name="Submit" value="Update" class="btn btn-theme"></div>
                          </form>
                      </div>
                  </div>
              </div>
		</section>
        <?php } ?>
		<form action="homepage.php" method="post">
			<div class="imgcontainer">
				<img src="logo100.png" alt="Avatar" class="avatar">
			</div>
			<div class="inner_container">
				<form method="POST" action="caregiverlogin.php" enctype="multipart/form-data">
					<div id="content">
			 	   <form method="POST" action="homepage.php" enctype="multipart/form-data">
			 	   	<input type="hidden" name="size" value="1000000">
			 	   	<div>
			 	   	  <input type="file" name="image">
			 	   	</div>
			 	   	<div>
			 	       <textarea
			 	       	id="text"
			 	       	cols="40"
			 	       	rows="4"
			 	       	name="text"
			 	       	placeholder="Say something about this image..."></textarea>
			 	   	</div>
			 	   	<div>
			 	   		<button type="submit" name="upload">POST</button>
			 	   	</div>
			 	   </form>
			 	 </div>
				<button class="logout_button" name="logout" type="submit">Log Out</button>
			</div>
		</form>
		<?php
			if(isset($_POST['logout']))
			{
				session_destroy();
				header("location:caregiverlogin.php");
			}
		?>
	</div>
</body>
</html>
