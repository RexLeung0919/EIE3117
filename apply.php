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

$id=$_GET['jobid'];
$user=$_COOKIE['user'];

    $sql="INSERT INTO apply(jobid,uid) value(?,?)";
    $stmt2=$mysqli->prepare($sql);
    $stmt2->bind_param("ss",$id ,$user);
    $stmt2->execute();
    $stmt2->store_result();
    header("location:Individual.php");
    //mysqli_query($mysqli,"INSERT INTO apply(jobid,uid) value($id,$user)");
    

?>