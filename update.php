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



if($_SERVER["REQUEST_METHOD"] == "POST"){

    $job_title=$_POST['job_title'];
    $job_requirement=$_POST['job_requirement'];
    $job_duty=$_POST['job_duty'];
    $salary=$_POST['salary'];
    (int)$jobid=$_COOKIE['jobidcookie'];

    $sql="UPDATE job set job_title=?, job_requirement=?, job_duty=? ,salary=? WHERE jobid=?";
    echo $sql;
    $stmt=$mysqli->prepare($sql);
    $stmt->bind_param("ssssi", $job_title, $job_requirement, $job_duty, $salary, $_COOKIE['jobidcookie']);
    $stmt->execute();

    $message = "Record Modified Successfully";
    header("location:Company.php");
    }
    
$result = mysqli_query($mysqli,"SELECT * FROM job WHERE jobid=".$_GET['jobid']."");
$row= mysqli_fetch_array($result);
setcookie('jobidcookie',$_GET['jobid'],time()+50000)
?>

<html>
<head>
    <title>Update Job</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <div><?php if(isset($message)) { echo $message; } ?></div>
        <div style="padding-bottom:5px;"></div>
        Job ID: <br>
        <input disabled="true" type="text" name="id"  value="<?php echo $row['jobid']; ?>">
        <br>

        Job Title: <br>
        <input type="text" name="job_title" value="<?php echo $row['job_title']; ?>">
        <br>
        Job Requirement(s):<br>
        <textarea rows = "5" cols = "66" name="job_requirement"><?php echo $row['job_requirement']; ?>
        </textarea>
        <br>
        job_duty:<br>
        <textarea rows = "5" cols = "66" name="job_duty"><?php echo $row['job_duty']; ?>
        </textarea>
        <br>
        Salary(HKD):<br>
        <input type="text" name="salary" value="<?php echo $row['salary']; ?>">
        <br>
        <input type="submit" name="submit" value="Submit" class="but">

</form>
</body>
</html>