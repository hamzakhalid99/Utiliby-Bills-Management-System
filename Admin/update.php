<!DOCTYPE html>
<html>
<head>
</head>
<body>
<h3>Update Data</h3>

<form method="POST">
  <input type="text" name="fixed_monthly_price" placeholder=" Enter fixed monthly price" Required><br/>
  <input type="text" name="unit_price" placeholder=" Enter unit price" Required><br/>
  <input type="submit" name="update" value="update">
</form>
<?php
include "../DB_Connection/database_connection.php";


//$update_q = mysqli_query($connect,"select * from Utilities where utility_id='$id'"); // select query
//$data = mysqli_fetch_array($update_q); // fetch data
if(isset($_POST['update'])) // when click on Update button
{
    echo "Changes saved";
    $id = $_GET['id']; // get id through query string
    echo $id;
    $monthly = $_POST['fixed_monthly_price'];
    $unit = $_POST['unit_price'];
    $edit = mysqli_query($connect,"update Utilities set fixed_monthly_price='$monthly', unit_price='$unit' where utility_id='$id'");
	
    if($edit)
    {
        mysqli_close($connect);
        header("location:view_update.php"); // redirects to all records page
        exit;
    }
    else
    {
        echo "Error updating record"; // display error message if not delete;
    }    	
}
else
{
    echo "Click update to save changes";
}
?>
