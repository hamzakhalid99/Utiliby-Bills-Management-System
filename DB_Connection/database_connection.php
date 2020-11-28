<?php 
    $connect = mysqli_connect("localhost", "root", "", "DB-Project");
    if (!$connect)
        echo "ERR_CONNECTION_FAILED";
?>