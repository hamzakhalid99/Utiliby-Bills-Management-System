<?php 
    session_start();
    if (!isset($_SESSION["cnic"]))
    {
        header("Location: ../");
    }
?>
