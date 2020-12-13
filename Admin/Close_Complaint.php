<?php 
include "../DB_Connection/database_connection.php";
include "../time/curr_time.php";
$id = $_POST['complaint_id']; // get id through query string
$update_q="UPDATE complaint SET complaint_status=b'0', resolution_date='".$curr_time."' WHERE complaint_id='".$id."'";
echo "$id";
$up = mysqli_query($connect,$update_q); // delete query

if($up)
{
    // header("location: View_Complaints.php"); // redirects to all records page
}
else
{
    echo mysqli_error($connect);
    echo "Error closing record"; // display error message if not delete
}
?>
