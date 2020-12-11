<?php
	include "../DB_Connection/database_connection.php";
	session_start();
	if (!isset($_SESSION['logged_in']))
	{
		header("Location: ../index.html");

	}

	$utility_id = $_GET['id'];
	$balance = $_GET['balance'];
	$user_id = $_SESSION['user_id'];
	if ($balance == 0)
	{
		$query = "DELETE FROM Registers_For WHERE utility_id='" .$utility_id. "' AND user_id='".$user_id."';";
		$query_result = mysqli_query($connect, $query);
		if ($query_result)
		{
			header('Location: Home_Page.php');
		}
		else
		{
			header('Location: Home_Page.php');
		}
	}
	else 
	{
		header('Location: Pay_Bills.php?utility_id='.$utility_id.'');
	}
	
?>