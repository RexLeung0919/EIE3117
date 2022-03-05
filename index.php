<!DOCTYPE html>
<?php
// Initialize the session
session_start();
ob_start();
 
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'login');
 
/* Attempt to connect to MySQL database */
$mysqli = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

 
// Define variables and initialize with empty values
$username = $password = $loggedin = $type= $profile_img = "";
$username_err = $password_err = "";
if(!empty($_COOKIE["usernamecookie"]) && !empty($_COOKIE["passwordcookie"]) && isset($_COOKIE["auto_sign_in"])){
    // Redirect user to welcome page
    if($_COOKIE["type"] == "Company"){
        header("location:Company.php");
    }
    else{
        header("location:Individual.php"); 
    }
}else{
    ;
}


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){


    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT uid, username, password, type, profile_img FROM users WHERE username = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store result
                $stmt->store_result();
                
                // Check if username exists, if yes then verify password
                if($stmt->num_rows == 1){                    
                    // Bind result variables
                    $stmt->bind_result($id, $username, $hashed_password, $type, $profile_img);
                    if($stmt->fetch()){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username; 
                            $_SESSION["type"] = $type;
                            if(empty($profile_img)){
                                $profile_img="noimage.jpg";
                            }
                            $loggedin = "true";
                            $autosignin="true";
                            //set the cookie
                            setcookie("loggedin",$loggedin,time()+50000);
                            setcookie("user",$username,time()+50000);
                            setcookie("file",$profile_img,time()+50000);
                            setcookie("type",$type,time()+50000);
                            if(isset($_POST["auto_sign_in"])){
                                setcookie("auto_sign_in",$autosignin,time()+50000);
                            }
                            if($_SESSION['type'] == 'Company'){
                                // Redirect user to Company page
                                if(isset($_POST["remember_me"])){
                                    setcookie("usernamecookie",$username,time()+50000);
                                    setcookie("passwordcookie",$password,time()+50000);
                                    setcookie("remember_me","remember_me",time()+50000);
                                    header("location:Company.php");
                                }
                                else{
                                    header("location:Company.php"); 
                                }
                            } else {
                                if(isset($_POST["remember_me"])){
                                    setcookie("usernamecookie",$username,time()+50000);
                                    setcookie("passwordcookie",$password,time()+50000);
                                    setcookie("remember_me","remember_me",time()+50000);
                                    header("location:Individual.php");
                                }
                                else{
                                    header("location:Individual.php"); 
                                }
                                
                            }
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
		
        
        // Close statement
        $stmt->close();
    }
    
    // Close connection
    $mysqli->close();
}
?>
<html lang="en">
<head>
    <title>User Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div>
        <div>
            <div><h1>Login to your account</h1></div>
        </div>
    <form method = 'POST' action = 'index.php' >
        <div class="form-group">
            <label>Username/Login id : </label>
            <br>
            <div>
            <input type="text" name="username" value="<?php if(!empty($_COOKIE["usernamecookie"])){ echo $_COOKIE["usernamecookie"] ;}?>"><br>
            <span class="err"><?php echo $username_err; ?></span>
            </div>
            <br>
            <label>Password :</label>
            <br>
            <div>
            <input type="password" name="password" value="<?php if(isset($_COOKIE["passwordcookie"])){ echo $_COOKIE["passwordcookie"] ;}?>"><br>
            <span class="err"><?php echo $password_err; ?></span>
            </div>
            <div><input type="checkbox" name="remember_me"><label>Remenber me</label></div>
            <div><input type="checkbox" name="auto_sign_in"><label>Auto Sign in</label></div>
            <br>

        </div>
        <button class="but" type="submit" name="login" value='login'>Login</button>
    </form>

    <div id="footer-box">
        <p>Register to be our member? <a href="/register.php" class="sign-up">Sign up now</a></p>
    </div>

    </div>

</body>
</html>