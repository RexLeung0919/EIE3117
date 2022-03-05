<?php
// Initialize the session
session_start();

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'login');
 
/* Attempt to connect to MySQL database */
$mysqli = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
///////////////////////////////////////////////////////////////////////////////////////////

if($_COOKIE["loggedin"] != "true"){
    // Redirect user to page login
    header("location:index.php");
}else{
    ;
}

$sql="DELETE FROM job WHERE jobid=?";
$stmt=$mysqli->prepare($sql);
$stmt->bind_param("i",$_GET['jobid']);
$stmt->execute();

$message = "Record Modified Successfully";
header("location:Company.php");
?>