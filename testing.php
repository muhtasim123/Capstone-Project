$album=$_POST['album'];
$uid=intval($_GET['uid']);
$link=htmlspecialchars($upload->get('ObjectURL'));
$query=mysqli_query($con,"INSERT INTO media (patientid, album, link)
VALUES ($uid, $album, $link)");
$upload = $s3->upload($bucket, $_FILES['userfile']['name'], fopen($_FILES['userfile']['tmp_name'], 'rb'), 'public-read');




        <p>Upload <a href="<?=htmlspecialchars($upload->get('ObjectURL'))?>">successful</a> :)</p>



        if($password==$cpassword)
        {
          //echo $query;
        $query_run=mysqli_query($con,"select * from caregiver where name='$username'");
        //echo mysql_num_rows($query_run);
        if($query_run)
          {
            if(mysqli_num_rows($query_run)>0)
            {
              echo '<script type="text/javascript">alert("This Username Already exists.. Please try another username!")</script>';
            }
            else
            {



              else
              {
                echo '<p class="bg-danger msg-block">Registration Unsuccessful due to server error. Please try later</p>';
              }
            }
          else
          {
            echo '<script type="text/javascript">alert("DB error")</script>';
          }
        else
        {
          echo '<script type="text/javascript">alert("Password and Confirm Password do not match")</script>';
        }
