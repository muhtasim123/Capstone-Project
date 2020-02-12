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
