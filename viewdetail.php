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
 
$result = mysqli_query($mysqli,"SELECT * FROM job WHERE jobid=".$_GET['jobid']."");
$row= mysqli_fetch_array($result);
setcookie('jobidcookie',$_GET['jobid'],time()+50000)
?>

<html>
<head>
    <title>View Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <table class="job">
        <tr>
            <th>
            Job ID:
            </th>
            <td>
            <?php echo $row['jobid']; ?>
            </td>
        </tr>

        <tr>
            <th>
            Job Title:
            </th>
            <td>
            <?php echo $row['job_title']; ?>
            </td>
        </tr>

        <tr>
            <th>
            Job Requirement(s):
            </th>
            <td>
            <?php echo $row['job_requirement']; ?>
            </td>
        </tr>


        <tr>
            <th>
            Job Duty:<br>
            </th>
            <td>
            <?php echo $row['job_duty']; ?>
            </td>
        </tr>

        <tr>
            <th>
            Salary(HKD):
            </th>
            <td>
            <?php echo $row['salary']; ?>
            </td>
        </tr>

    </table>
    <a href="applyjob.php?jobid=<?php echo $row["jobid"]; ?>">Apply</a>
    
    
</body>
</html>