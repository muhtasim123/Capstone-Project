<?php
	session_start();
	require_once('dbconfig/config.php');
	require('vendor/autoload.php');
// this will simply read AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY from env vars
$s3 = Aws\S3\S3Client::factory();
$bucket = getenv('S3_BUCKET')?: die('No "S3_BUCKET" config var in found in env!');
	//phpinfo();
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
		<div class="imgcontainer">
				<img src="logo100.png" alt="Avatar" class="avatar">
			</div>
<?php

		$firstname=$_SESSION['name'];?>

		<?php
		$ret=mysqli_query($con,"select * from patient where fname='$firstname'");
	  while($row=mysqli_fetch_array($ret))

	  {?>
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
        <?php } ?>
				<section class="wrapper">
				<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['userfile']) && $_FILES['userfile']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['userfile']['tmp_name'])) {
    // FIXME: add more validation, e.g. using ext/fileinfo
    try {
        // FIXME: do not use 'name' for upload (that's the original filename from the user's computer)
        $upload = $s3->upload($bucket, $_FILES['userfile']['name'], fopen($_FILES['userfile']['tmp_name'], 'rb'), 'public-read');
?>
        <p>Upload <a href="<?=htmlspecialchars($upload->get('ObjectURL'))?>">successful</a> :)</p>
<?php } catch(Exception $e) { ?>
        <p>Upload error :(</p>
<?php } } ?>
      <center><h2>Upload a file</h2></center>
        <center><form enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']?>" method="POST"></center>
            <center><input name="userfile" type="file"><input type="submit" value="Upload"></center>
        </form>

				<?php
				require('vendor/autoload.php');
				// this will simply read AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY from env vars
				$s3 = Aws\S3\S3Client::factory();
				$bucket = getenv('S3_BUCKET')?: die('No "S3_BUCKET" config var in found in env!');
				?>
				<html>
				    <head><meta charset="UTF-8"></head>
				    <body>
				       <center><h1>Your Stored Files</h1></center>
				<?php
					try {
						$objects = $s3->getIterator('ListObjects', array(
							"Bucket" => $bucket
						));
						foreach ($objects as $object) {
				?>
						<center><p><a href="<?=htmlspecialchars($s3->getObjectUrl($bucket, $object['Key']))?>"> <?echo $object['Key'] . "<br>";?></a></p></center>

				<?		}?>

				<?php } catch(Exception $e) { ?>
				        <p>error :(</p>
				<?php }  ?>
			</section>
				<a href="logout.php"><button type="button" class="back_btn">Logout</button></a>
				    </body>
				</html>

	</div>
</body>
</html>
