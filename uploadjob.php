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
    <h1>Upload New job</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">


                <div>
                    <label>Job Title</label><br>
                    <input type="text" name="job_title">
                </div>    

                <div>
                    <label>Job Requirement(s)</label><br>
                    <textarea rows = "5" cols = "45" name = "job_requirement">Enter details here...
                    </textarea>
                    </div>

                <div>
                    <label>Job_Duty(s)</label><br>
                    <textarea rows = "5" cols = "45" name = "job_duty">Enter details here...
                    </textarea>
                    <br>
                </div>
                <div>
                    <label>Salary(HKD)</label><br>
                    <input type="text" name="salary" value="TBC">
                </div>

                <br>

                <div>
                    <input class="but" type="submit" value="Submit">
                    <input class="but" type="reset" value="Reset">
                </div>
            </form>

</body>
</html>