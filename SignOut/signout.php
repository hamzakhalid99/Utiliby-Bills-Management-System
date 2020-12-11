<?php 
    session_start();
    $_SESSION["user_id"] =
    $_SESSION["name"] = 
    $_SESSION["cnic"] = 
    $_SESSION["contact_number"] = 
    $_SESSION["email_id"] = 
    $_SESSION["address"] = 
    $_SESSION["username"] = null;
    
    header("Location: ../index.html");
?>
