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
$result="";
$filename = "";
if($_COOKIE["loggedin"] != "true"){
    // Redirect user to welcome page
    header("location:index.php");
}else{
    ;
}
////////////////////////////////////////////////////////////////////////////////////////
//show database data

$username = $_COOKIE["user"];
$sql = "SELECT * FROM users WHERE username = '$username'";
$resultusers = mysqli_query($mysqli,$sql);
$rowusers = mysqli_fetch_array($resultusers);

$sql = "SELECT * FROM job WHERE empolyer = '$username'";
$resultjob = $mysqli->query($sql);


//////////////////////////////////////////////////////////////////////////////////////////
//upload job to database
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $job_title=$_POST["job_title"];
    $job_requirement=$_POST["job_requirement"];
    $job_duty=$_POST["job_duty"];
    $salary=$_POST["salary"];



$sql = "INSERT INTO job (empolyer , job_title, job_requirement, job_duty, salary) VALUES (?, ?, ?, ?, ?)";
if($stmt = $mysqli->prepare($sql)){
    // Set parameters
    $job_title=$_POST["job_title"];
    $job_requirement=$_POST["job_requirement"];
    $job_duty=$_POST["job_duty"];
    $salary=$_POST["salary"];
    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("sssss",$username, $job_title, $job_requirement, $job_duty, $salary);
    // Attempt to execute the prepared statement
    if($stmt->execute()){
        echo "Your job Uploaded.";
        }
    } else{
        echo "Something went wrong. Please try again later.";
    }
    
}

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
            <h3> <?php echo "User Name/Company: " . $rowusers["username"] ?> </h3>
            <td><a href="viewuserapplydetail.php?userid=<?php echo $rowusers["username"]; ?>">View Apply History</a></td>
            <h3> The job uploaded by you/your company: </h3>
            <?php
            if($resultjob -> num_rows >0){
            ?>
            <table class="job">
                <tr>
                    <th>Job_Title</th>
                    <th>Salary</th>
                    <th>Update/View</th>
                    <th>Delete</th>
                    <th>Check</th>
                    
                </tr>
                <?php 
                $countrow = 0;
                    while($rowjob = $resultjob-> fetch_assoc()){
                        ?>
                    <tr>
                    <td> <?php echo $rowjob["job_title"];?></td>
                    <td>$<?php echo $rowjob["salary"];?></td>
                    <td><a href="update.php?jobid=<?php echo $rowjob["jobid"]; ?>">Update</a></td>
                    <td><a href="deletejob.php?jobid=<?php echo $rowjob["jobid"]; ?>">Delete</a></td>
                    <td><a href="personhunt.php?jobid=<?php echo $rowjob["jobid"]; ?>">History</a></td>
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
        <iframe class="uploadjob" src="uploadjob.php" title="uploadjob"></iframe>
        </div>
    
    </div>
    


</body>
</html>