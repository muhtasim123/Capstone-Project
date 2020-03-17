<?php
	session_start();
	include'dbconnection.php';
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
				<section class="wrapper">
				<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['userfile']) && $_FILES['userfile']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['userfile']['tmp_name'])) {
    // FIXME: add more validation, e.g. using ext/fileinfo
    try {
        // FIXME: do not use 'name' for upload (that's the original filename from the user's computer)
				$album=$_POST['album'];
				$uid=intval($_GET['uid']);
				$link=htmlspecialchars($upload->get('ObjectURL'));
				$query=mysqli_query($con,"INSERT INTO media (patientid, album, link)
				VALUES ($uid, $album, $link)");
        $upload = $s3->upload($bucket, $_FILES['userfile']['name'], fopen($_FILES['userfile']['tmp_name'], 'rb'), 'public-read');
?>
        <p>Upload <a href="<?=htmlspecialchars($upload->get('ObjectURL'))?>">successful</a> :)</p>
<?php } catch(Exception $e) { ?>
        <p>Upload error :(</p>
<?php } } ?>
      <center><h2>Upload a file</h2></center>

        <center><form enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']?>" method="POST"></center><br><br>
					<label for="album">Album Name:</label>
  				<input type="text" id="album" name="album"><br><br>
            <center><input name="userfile" type="file"><br><br>
							<input type="submit" value="Upload""></center>
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
