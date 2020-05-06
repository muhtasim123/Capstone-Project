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


?>

