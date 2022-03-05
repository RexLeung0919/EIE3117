<?php
// Initialize the session
session_start();
$id = $_COOKIE["user"];
$file = $_COOKIE["file"];
$type = $_COOKIE["type"];

$filename= "profile/$file";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Company User Site</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div>
    
    <div class= "leftuser">
        <img class="profile" src=<?php echo $filename; ?> alt="">
    </div>


    <div class= "rightuser">
        <table>
        <tr>
            <th>Username:</th>
            <td><?php echo $id; ?></td>
        </tr>
        <tr>
            <th>User Type:</th>
            <td><?php echo $type; ?></td>
        </tr>
        </table>
    </div>

    

</div>


</body>
</html>