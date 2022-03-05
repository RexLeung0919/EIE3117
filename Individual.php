<?php
session_start();

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'login');
 
/* Attempt to connect to MySQL database */
$mysqli = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
///////////////////////////////////////////////////////////////////////////////////////////
$result="";
if($_COOKIE["loggedin"] != "true"){
    // Redirect user to page login
    header("location:index.php");
}else{
    ;
}

$username=$_COOKIE['user'];

$sql = "SELECT * FROM users WHERE username = '$username'";
$resultusers = mysqli_query($mysqli,$sql);
$rowusers = mysqli_fetch_array($resultusers);

$sql = "SELECT * FROM job";
$resultjob = $mysqli->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Company User Site</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div>
        <div class= "left">
            <iframe class="userinfo" src="userinfo.php" title="userinfo"></iframe>
        </div>

        <div class= "right">
            <a class="logout" href="logout.php">Logout</a>
        </div>

    </div>

    <div>
        <div class= "Companyleft">
            <h3> <?php echo "User Name: " . $rowusers["username"] ?> </h3> 
            <td><a href="applyhistory.php?userid=<?php echo $rowusers["username"]; ?>">Apply History</a></td>
            <h3> The job uploaded company: </h3>
            <?php
            if($resultjob -> num_rows >0){
            ?>
            <table class="job">
                <tr>
                    <th>Company</th>
                    <th>Job_Title</th>
                    <th>Salary</th>
                    <th>Action</th>
                    <th>Action</th>
                    
                </tr>
                <?php 
                $countrow = 0;
                    while($rowjob = $resultjob-> fetch_assoc()){
                        ?>
                    <tr>
                    <td> <?php echo $rowjob["empolyer"];?></td>
                    <td> <?php echo $rowjob["job_title"];?></td>
                    <td>$<?php echo $rowjob["salary"];?></td>
                    <td><a href="viewdetail.php?jobid=<?php echo $rowjob["jobid"]; ?>" target="iframe_view" >View details</a></td>
                    <td><a href="applyjob.php?jobid=<?php echo $rowjob["jobid"]; ?>">Apply</a></td>
                    </tr>

                <?php
			    $countrow++;
			    }
			    ?>


            </table>
            <?php
            }
            else
            {
            echo "No result";
            }
            ?>

        </div>
        
        <div class= "Companyright">
        <iframe name="iframe_view" class="uploadjob" src="" title="applyjob"></iframe>
        </div>
    
    </div>
    


</body>
</html>