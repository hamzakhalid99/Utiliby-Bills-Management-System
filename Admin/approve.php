<?php
    include "../DB_Connection/database_connection.php";
    $update_query = "UPDATE User SET approved_bit = 1 WHERE user_id = $_GET[approve_id]";
    $query = mysqli_query($connect, $update_query);
    if ($query )
        header("Location: view_approve.php");
    else 
        echo mysqli_error($connect);
?>