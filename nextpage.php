<?php 
session_start();
//creating a connection
$mysqli = new mysqli("db", "root", "toor", "sample", 3306);

//checking connection
if($mysqli->connect_error){
    die("Connection failed: " . $mysqli->connect_error);
}

$currAlbum = $_REQUEST['currentAlbum'];
$currProfile = $_REQUEST['currentProfileID'];


$redirectURL = "/";
$redirectTime = 3;

function checkAlbumSelected($currprof, $curralbm, &$redirurl, &$redirtime) {
    if(!isset($_REQUEST['selectedAlbum'])) {
        $redirurl = "albumgallery.php?profileid={$currprof}&albumname={$curralbm}";
        $redirtime = 5;
        
        echo "<p>No target album was selected. Going back.</p>";
        echo "<br/>";
        echo "<a href='albumgallery.php?profileid={$currProfile}&albumname={$curralbm}'>Click here if the browser is not automatically redirecting in {$redirectTime} seconds.</a>";
    }
}

function transformGalleryID($gallerySelected) {
    return array_map(function($galleryid) {
        return $_SESSION['galleryDataID'][$galleryid];
    }, $gallerySelected);
    
}


function transformGalleryURL($gallerySelected) {
    return array_map(function($galleryid) {
        return $_SESSION['galleryDataURL'][$galleryid];
    }, $gallerySelected);
    
}



if(!isset($_REQUEST['gallery'])) {
    $redirectURL = "albumgallery.php?profileid={$currProfile}&albumname={$currAlbum}";
    $redirectTime = 5;
    echo "<p>No image was selected. Going back.</p>";
    echo "<br/>";
    echo "<a href='albumgallery.php?profileid={$currProfile}&albumname={$currAlbum}'>Click here if the browser is not automatically redirecting in {$redirectTime} seconds.</a>";
} else {

    switch($_REQUEST['submitButton']) {
    case 'Copy':
        checkAlbumSelected($currProfile, $currAlbum, $redirectURL, $redirectTime);
        copyToAlbum($mysqli, $currProfile ,transformGalleryURL($_REQUEST['gallery']), $_REQUEST['selectedAlbum'] );

        $redirectURL = "albumgallery.php?profileid={$currProfile}&albumname={$currAlbum}";
        $redirectTime = 24;
        break;
    case 'Move':
        checkAlbumSelected($currProfile, $currAlbum, $redirectURL, $redirectTime);
        
        moveToAlbum($mysqli, transformGalleryID($_REQUEST['gallery']), $_REQUEST['selectedAlbum']);
        
        $redirectURL = "albumgallery.php?profileid={$currProfile}&albumname={$currAlbum}";
        $redirectTime = 0;
        break;
    case 'Delete':
        deleteFromAlbum($mysqli, transformGalleryID($_REQUEST['gallery']), transformGalleryURL($_REQUEST['gallery']));
        $redirectURL = "albumgallery.php?profileid={$currProfile}&albumname={$currAlbum}";
        $redirectTime = 0;
        break;
    case 'Play From First Selected':
        $firstSelect = transformGalleryID($_REQUEST['gallery'])[0];
        $redirectTime = 0;
        $redirectURL= "profiles.php?profileid={$currProfile}&albumname={$currAlbum}&startpicture={$firstSelect}";
        break;
    }
}

function moveToAlbum($connect, $tableIDs, $album) {

    $query = "UPDATE profile_data SET album=? WHERE id=?";
    $stmt = $connect->prepare($query);

    $stmt->bind_param('si', $album, $id);

    foreach($tableIDs as $id) {
        $stmt->execute();
    }
    $stmt->close();

}

function deleteFromAlbum($connect, $tableIDs, $tableURLs) {
    $query = "DELETE FROM profile_data WHERE id=?";
    $stmt = $connect->prepare($query);

    $stmt->bind_param('i', $id);

    foreach($tableURLs as $url) {
        unlink($url);
    }

    foreach($tableIDs as $id) {
        $stmt->execute();
    }
    $stmt->close();
    
}

function copyToAlbum($connect, $currProfile, $tableURLs, $album) {
    $query = "INSERT INTO profile_data (profile_id, type, url, album, tag) VALUES (?, \"picture\", ?, ?, \"\")";
    $stmt = $connect->prepare($query);

    $stmt->bind_param('iss', $currProfile, $newurl, $album);
    
    $newurls = [];
    foreach($tableURLs as $oldurl) {
        $newname = pathinfo($oldurl, PATHINFO_DIRNAME) . "/" . uniqid("copy") . ".". pathinfo($oldurl, PATHINFO_EXTENSION);

        copy($oldurl, $newname);
        array_push($newurls, $newname);
    }

    foreach($newurls as $newurl) {

        print_r($currProfile);
        print_r($newurl);
        print_r($album);
        $stmt->execute();
    }

    $stmt->close();
}

/*
print_r($_SESSION['galleryDataID']);
print_r($_SESSION['galleryDataURL']);
print_r($_REQUEST['gallery']);
print_r(transformGallery($_REQUEST['gallery']));
/*
print_r($_REQUEST);

print_r($redirectURL);
*/
/*
//function to copy images from one album to another
function copyAlbum($connect){
    $profile = $_GET['profileid'];
    $album = $_GET['albumname'];
    $copyFile="path/filename";//might need to change this
    $copied = copy($album, $copyfile);
    if(!$copied){
        echo "Copy Failed";
    }
    else{
        echo "Copy Successful";
    }
}

//function to move images from album to another
function moveAlbum($connect, $file, $to){
    $profile = $_GET['profileid'];
    $album = $_GET['albumname'];
    $file = $album;
    $path_parts = pathinfo($file);
    $newplace = "$to/{$path_parts['basename']}";
    if(rename($file, $newplace))
    {
        return $newplace;
    }
    return null;
}

//functio to move files from one album to another
function moveAlbum2($connect){
    $profile = $_GET['profileid'];
    $album = $_GET['albumname'];
    $moveFile="path/filename";//might need to change this
    $moved = copy($album, $moveFile);
    if(!moved){
       echo "Moved Failed";
    }
    else{
        unlink($album);
        echo "Move Successfull";
    }
}
*/
?>

<meta http-equiv="refresh" content="<?php echo $redirectTime; ?>; URL='<?php echo $redirectURL; ?>'"/> 
