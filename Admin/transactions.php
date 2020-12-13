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
        <h2 style="text-align: center; ">View Transactions</h2>
    </div>
	</div>
    <hr style="border-width: 2px;">
    <br>
    <table class="table" style = "text-align: center; ">
	<thead class="thead-dark">
	    <tr>
	        <th>User ID</th>
	        <th>Payment ID</th>
	        <th>Invoice ID</th>
	        <th>Name</th>
	        <th>Utility Name</th>
	        <th>Package</th>
	        <th>Amount</th>
	        <th>Date</th>
	    </tr>
	</thead>
    <?php
    	$query = "SELECT E.user_id, T.payment_amount, T.invoice_id, T.payment_id, T.Date, E.utility_name, E.connection_type, E.name
					FROM 
					(SELECT * FROM User INNER JOIN (SELECT * FROM invoice INNER JOIN Utilities USING(utility_id)) AS S USING(user_id)) AS E
					INNER JOIN 
					(SELECT * FROM Payments INNER JOIN Invoice_Payments USING(payment_id)) AS T 
					USING(invoice_id) ORDER BY T.Date DESC";
		$tuples = mysqli_query($connect, $query);
		while ($row = mysqli_fetch_assoc($tuples))
		{

			$user_id = $row['user_id'];
			$payment_id = $row['payment_id'];
			$invoice_id = $row['invoice_id'];
			$name = $row['name'];
			$utility_name = $row['utility_name'];
			$package = $row['connection_type'];
			$amount = $row['payment_amount'];
			$date = $row['Date'];
			echo 
			'<tr>
	        <td>'.$user_id.'</td>
	        <td>'.$payment_id.'</td>
	        <td>'.$invoice_id.'</td>
	        <td>'.$name.'</td>
	        <td>'.$utility_name.'</td>
	        <td>'.$package.'</td>
	        <td>'.$amount.'</td>
	        <td>'.$date.'</td>
	    	</tr>';
		}
    ?>
    </table>
</div>

</body>
<script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>