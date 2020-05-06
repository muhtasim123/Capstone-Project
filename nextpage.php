<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

$servername = "us-cdbr-iron-east-04.cleardb.net";
$username = "bc9da719e482f3";
$password = "deea7ef6";
$dbname = "heroku_dbefbfd5b04ac35";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn1 = mysqli_connect($servername, $username, $password, $dbname);
$conn2 = new mysqli($servername, $username, $password, $dbname);
var_dump($conn1->stat, $conn2->stat);



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




?>


