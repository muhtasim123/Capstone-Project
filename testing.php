$album=$_POST['album'];
$uid=intval($_GET['uid']);
$link=htmlspecialchars($upload->get('ObjectURL'));
$query=mysqli_query($con,"INSERT INTO media (patientid, album, link)
VALUES ($uid, $album, $link)");
$upload = $s3->upload($bucket, $_FILES['userfile']['name'], fopen($_FILES['userfile']['tmp_name'], 'rb'), 'public-read');




        <p>Upload <a href="<?=htmlspecialchars($upload->get('ObjectURL'))?>">successful</a> :)</p>
