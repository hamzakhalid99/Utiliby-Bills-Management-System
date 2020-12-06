<?php
	include "../DB_Connection/database_connection.php";
	session_start();
	if (!isset($_SESSION['logged_in']))
	{
		header("Location: ../index.html");

	}

	$utility_id = $_GET['utility_id'];
	$user_id = $_SESSION['user_id'];
	$amount = $_POST['amount'];
	$invoice_id = $_POST['invoice_id'];
	$query = "SELECT * FROM invoice WHERE invoice_id='".$invoice_id."';";
	$invoice = mysqli_query($connect, $query);
	$invoice = mysqli_fetch_assoc($invoice);
	$curr_rec = $invoice['amount_received'] + $amount;

//updating invoice tables
	$new_due = $invoice['bill_due'] - $amount;
	$bill_query = "INSERT INTO invoice(user_id, utility_id, bill_amount, amount_received, bill_due, bill_status, bill_generation_date, date_of_payment)";
                $bill_query .= "VALUES($user_id, '$id', $bill_amount, 0, $bill_amount, 1, now(), NULL);";
	if ($new_due <= 0)
	{
		$update_query = "UPDATE invoice SET amount_received='".$curr_rec."', bill_due='0', bill_status=b'0', date_of_payment=now() 
						WHERE invoice_id='".$invoice_id."';";
	}
	else
	{
		$update_query = "UPDATE invoice SET amount_received='".$curr_rec."', bill_due='".$new_due."' 
						WHERE invoice_id='".$invoice_id."';";
	}

	$update = mysqli_query($connect, $update_query);

//updating balances
	$query2 = "SELECT * FROM Registers_For INNER JOIN (SELECT * FROM User INNER JOIN Customer USING(user_id)) AS T USING(user_id)
				WHERE user_id='".$user_id."' AND utility_id='".$utility_id."';";
	$update2 = mysqli_query($connect, $query2);
	$update2 = mysqli_fetch_assoc($update2);
	$balance = $update2['balance'];
	$util_balance = $update2['utility_balance'];
	$new_balance = $balance + $amount;
	$new_util_balance = $util_balance + $amount;
	$balance_query = "UPDATE Customer SET balance='".$new_balance."' WHERE user_id='".$user_id."';";
	$util_balance_query = "UPDATE Registers_For SET utility_balance='".$new_util_balance."' 
							WHERE user_id='".$user_id."' AND utility_id='".$utility_id."';";
	$update2 = mysqli_query($connect, $util_balance_query);
	$update2 = mysqli_query($connect, $balance_query);
	
//payment tables update
	$get_query = "SELECT `AUTO_INCREMENT`
					FROM  INFORMATION_SCHEMA.TABLES
					WHERE TABLE_SCHEMA = 'DB-Project'
					AND   TABLE_NAME   = 'Payments';";
	$tuples = mysqli_query($connect, $get_query);
	$tuples = mysqli_fetch_assoc($tuples);
	$payment_id = $tuples["AUTO_INCREMENT"];
	$payment_query = "INSERT INTO Payments(user_id, payment_amount) VALUES(".$user_id.", ".$amount.");";
	$update2 = mysqli_query($connect, $payment_query);
	$payment_query2 = "INSERT INTO Invoice_Payments(payment_id, invoice_id) VALUES(".$payment_id.", ".$invoice_id.");";
	$update2 = mysqli_query($connect, $payment_query2);
	
?>