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
<table class="table table-striped table-advance table-hover">
	                  	  	  <h4><i class="fa fa-angle-right"></i> All User Details </h4>
	                  	  	  <hr>
                              <thead>
                              <tr>
                                  <th class="hidden-phone">First Name</th>
                                  <th> Last Name</th>
                              
                                  <th>Reg. Date</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php $ret=mysqli_query($con,"select * from patient");
							  $cnt=1;
							  while($row=mysqli_fetch_array($ret))
							  {?>
                              <tr>
                              <td><?php echo $cnt;?></td>
                                  <td><?php echo $row['fname'];?></td>
                                 <td><?php echo $row['lname'];?></td>
                                 
                                  <td><?php echo $row['datejoined'];?></td>  
                                  <td>
                                     
                                     <a href="update-profile.php?uid=<?php echo $row['id'];?>"> 
                                     <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
                                     <a href="manage-users.php?id=<?php echo $row['id'];?>"> 
                                     <button class="btn btn-danger btn-xs" onClick="return confirm('Do you really want to delete');"><i class="fa fa-trash-o "></i></button></a>
                                  </td>
                              </tr>
                              <?php $cnt=$cnt+1; }?>
                             
                              </tbody>
                          </table>
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
