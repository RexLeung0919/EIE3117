<?php
    session_start();
    session_destroy();
    setcookie("usernamecookie","",time()-50000);
    setcookie("passwordcookie","",time()-50000);
    setcookie("type","",time()-50000);
    setcookie("loggedin","",time()-50000);
    setcookie("user","",time()-50000);
    setcookie("remember_me","",time()-50000);
    setcookie("auto_sign_in","",time()-50000);
    header("location:index.php");

?>