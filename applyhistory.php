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

$sqlapply = "SELECT * FROM apply WHERE uid = '$username'";
$resultapply = $mysqli->query($sqlapply);

$sqlusers = "SELECT * FROM users WHERE username = '$username'";
//$stmt=$mysqli->prepare($sqlusers);
//$stmt->bind_param("s",$username);
//$stmt->execute();
$resultusers = mysqli_query($mysqli,$sqlusers);
$rowusers = mysqli_fetch_array($resultusers);

$sqljob = "SELECT * FROM job ";
$resultjob = $mysqli->query($sqljob);


?>

<!DOCTYPE html>
<html>
<head>
    <title>Company User Site</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div>
        <div class= "Companyleft">
            <h3> <?php echo "User Name: " . $rowusers["username"] ?> </h3> 
            <a class="logout" href="logout.php">Logout</a>
            <h3> The job you have applyed: </h3>
            <?php
            if($resultapply -> num_rows >0){
            ?>
            <table class="job">
                <tr>
                    <th>Job ID</th>
                    <th>Action</th>
                    
                </tr>
                <?php 
                $countrow = 0;
                    while($rowapply = $resultapply-> fetch_assoc()){
                        ?>
                    <tr>
                    <td> <?php echo $rowapply["jobid"];?></td>
                    <td><a href="viewdetail.php?jobid=<?php echo $rowapply["jobid"]; ?>" target="iframe_view" >View details</a></td>
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