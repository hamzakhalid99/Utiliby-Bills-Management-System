
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
  Monthly Price<input type="text" name="fixed_monthly_price" value="<?php echo $data['fixed_monthly_price'] ?>" placeholder=" Enter fixed monthly price" Required>
  Unit Price<input type="text" name="unit_price" value="<?php echo $data['unit_price'] ?>" placeholder=" Enter unit price" Required>
  <input type="submit" name="update" value="Update">
</form>
<?php
if(isset($_POST['update'])) // when click on Update button
{
    echo "Changes saved";

    $monthly = $_GET['fixed_monthly_price'];
    $unit = $_GET['unit_price'];
	
    $edit = mysqli_query($connect,"update Utilities set fixed_monthly_price='$monthly', unit_price='$unit' where id='$id'");
	
    if($edit)
    {
        mysqli_close($connect);
        header("location:all_records.php"); // redirects to all records page
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
