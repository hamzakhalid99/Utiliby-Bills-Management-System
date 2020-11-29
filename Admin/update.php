<?php
include "../DB_Connection/database_connection.php";

$id = $_GET['id']; // get id through query string
$update_q = mysqli_query($connect,"select * from Utilities where utility_id='$id'"); // select query
$data = mysqli_fetch_array($update_q); // fetch data
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<h3>Update Data</h3>

<form method="POST">
  Utility id <input type="text" name="utility_id" value="<?php echo $data['utility_id'] ?>" placeholder=" Enter utility id" ><br/>
  Connection type <input type="text" name="connection_type" value="<?php echo $data['connection_type'] ?>" placeholder=" Enter connection type" ><br/>
  Fixed monthly price <input type="text" name="fixed_monthly_price" value="<?php echo $data['fixed_monthly_price'] ?>" placeholder=" Enter fixed monthly price" ><br/>
  Unit Price <input type="text" name="unit_price" value="<?php echo $data['unit_price'] ?>" placeholder=" Enter unit price" ><br/>
  <input type="submit" name="update" value="update">
</form>
<?php
include "../DB_Connection/database_connection.php";

$id = $_GET['id']; // get id through query string
if(isset($_POST['update'])) // when click on Update button
{
    $util=$_POST['utility_id'];
    $conn=$_POST['connection_type'];
    $monthly = $_POST['fixed_monthly_price'];
    $unit = $_POST['unit_price'];
    $edit = mysqli_query($connect,"update Utilities set fixed_monthly_price='$monthly', unit_price='$unit',connection_type='$conn' ,utility_id='$util' where utility_id='$id'");
	
    if($edit)
    {
        echo "Changes saved";
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
