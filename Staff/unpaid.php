<?php 
    include "generic_layout.php";
    include "../DB_Connection/database_connection.php";
?>
<!DOCTYPE html>
<html lang = "en">
<head>
	<title> Admin / View Transactions </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
</head>
<body>
	<div class="container-fluid">
    <div class="row">
        <h2 style="text-align: center; ">Unpaid Bills</h2>
    </div>
	</div>
    <hr style="border-width: 2px;">
    <br>
    <table class="table" style="font-size: 20px;">
       <thead class="thead-dark">
      <tr>
        <th class='font-weight-light'>User ID</th>
        <th class='font-weight-light'>Utility ID</th>
        <th class='font-weight-light'>Name</th>
        <th class='font-weight-light'>Amount Unpaid</th>
        <th class='font-weight-light'>Due Date</th>
        <th class='font-weight-light'>Days Overdue</th>

      </tr>
    </thead>
    <tbody>
<?php
	$bills_due = "SELECT User.user_id, Registers_For.utility_id, User.name, Registers_For.due_date, Registers_For.days_overdue, 
				Registers_For.utility_balance 
                FROM `Registers_For` INNER JOIN User USING(user_id) 
                WHERE Registers_For.days_overdue>0;";
	$tuples = mysqli_query($connect,$bills_due); 

    while ($one_row = mysqli_fetch_assoc($tuples))
    {
    $user_id = $one_row["user_id"];
	$utility_id = $one_row["utility_id"];
	$name = $one_row["name"];
	$balance = $one_row["utility_balance"];
	$due = $one_row["due_date"];
	$due_days = $one_row["days_overdue"];

	echo 
	"<tr>
	<td class='font-weight-light'>".$user_id."</td>
	<td class='font-weight-light'>".$utility_id."</td>
	<td class='font-weight-light'>".$name."</td>
	<td class='font-weight-light'>".-$balance."</td>
	<td class='font-weight-light'>".$due."</td>
	<td class='font-weight-light'>".$due_days."</td>
	</tr>";
    }
?>
</tbody>
</table>
</div>



</body>
<script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>