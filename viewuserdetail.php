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
$user=$_GET['uid'];
$result = mysqli_query($mysqli,"SELECT * FROM users WHERE username='$user'");
$row= mysqli_fetch_array($result);
setcookie('jobidcookie',$_GET['uid'],time()+50000)
?>

<html>
<head>
    <title>View Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <Table class="job">
        <tr>
            <th>
            UID:
            </th>
            <td>
            <?php echo $row['uid']; ?>
            </td>
        </tr>

        <tr>
            <th>
            Username:
            </th>
            <td>
            <?php echo $row['username']; ?>
            </td>
        </tr>

        <tr>
            <th>
            Nick Name:
            </th>
            <td>
            <?php echo $row['nick_name']; ?>
            </td>
        </tr>

        <tr>
            <th>
            Email:
            </th>
            <td>
            <?php echo $row['email']; ?>
            </td>
        </tr>
        </Table>
</body>
</html>