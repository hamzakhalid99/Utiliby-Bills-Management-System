<?php 
include "../DB_Connection/database_connection.php";

$id = $_GET['id']; // get id through query string
$delete_q="delete FROM Utilities where utility_id='$id'";
$del = mysqli_query($connect,$delete_q); // delete query

if($del)
{
    header("location:view_update.php"); // redirects to all records page
    exit;	
}
else
{
    echo mysqli_error($connect);
    echo "Error deleting record"; // display error message if not delete
}
?>
