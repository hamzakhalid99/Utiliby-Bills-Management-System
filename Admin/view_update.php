<!DOCTYPE html>
<html lang = "en">
<head>
	<title> Admin / View and Update Utility </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
</head>

<body>
    <h2 style = "text-align: center; "> View and Update Utility </h2>
    <div style = "text-align: center; width: 100%">
    </div>
</body>
<table border="2">
  <tr>
    <th>User id</th>
    <td>Connection type</td>
    <td>Utility name</td>
    <td>Fixed montly price</td>
    <td>Unit price</td>
    <td>Update</td>
    <td>Delete</td>
  </tr>

<?php 
include "../DB_Connection/database_connection.php";
$sql = "SELECT * FROM Utilities";
$result =mysqli_query($connect,$sql);
while($data = mysqli_fetch_array($result))
{
?>
  <tr>
    <td><?php echo $data['utility_id']; ?></td>
    <td><?php echo $data['connection_type']; ?></td>
    <td><?php echo $data['utility_name']; ?></td>
    <td><?php echo $data['fixed_monthly_price']; ?></td>   
    <td><?php echo $data['unit_price']; ?></td>   
    <td><a href="update.php?id=<?php echo $data['utility_id']; ?>">Update</a></td>
    <td><a href="delete.php?id=<?php echo $data['utility_id']; ?>">Delete</a></td>
  </tr>	
<?php
}
?>
</table>
    <!-- // if ($result->num_rows > 0) 
    // {  
    // // output data of each row
    //     while($row = $result->fetch_assoc()) 
    //         {
    //         echo "|id: " . $row["utility_id"]. " | Connection Type: " . $row["connection_type"]. " |Name: " . $row["utility_name"]." |Fixed monthly price: ". 
    //         $row["fixed_monthly_price"]. " |Unit price: ". $row["unit_price"]. "<br>";
    //         }
    // } 
    // else {
    //     echo "0 results";
    //} -->
 
</body>
</html>