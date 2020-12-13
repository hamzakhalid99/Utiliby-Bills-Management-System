<?php
	include "../DB_Connection/database_connection.php";
	include "../time/curr_time.php";
	session_start();
	if (!isset($_SESSION['logged_in']))
	{
		header("Location: ../index.html");

	}
	if (!isset($_POST['complaint_type']))
	{
		$complaint_id = $_POST['complaint_id'];
		$msg = $_POST['msg'];
		$name = $_POST['sender'];
		$utility_id = $_POST['util_ID'];
		$query_2 = "INSERT INTO `Messages` (`complaint_id`, `sender_name`, `message_content`, `date_sent`) 
					VALUES ('".$complaint_id."', '".$name."', '".$msg."', '".$curr_time."')";
		$query_result = mysqli_query($connect, $query_2);
		header("Location: View_Complaint.php?utility_id=".$utility_id."&complaint_id=".$complaint_id."#scroll_thing");
	}
	else
	{
		$utility_id = $_POST['util_ID'];
		$type = $_POST['complaint_type'];
		$msg = $_POST['msg'];
		$user_id = $_SESSION['user_id'];
		$name = $_SESSION['name'];
		$query = "INSERT INTO `complaint` (`utility_id`, `user_id`, `complaint_status`, `complaint_desc`, `registeration_date`, 
				`resolution_date`, `escalation_status`) 
					VALUES ('".$utility_id."', '".$user_id."', b'1', '".$type."', '".$curr_time."', NULL, b'0')";
		$query_result = mysqli_query($connect, $query);

		$get_query = "SELECT `AUTO_INCREMENT`
						FROM  INFORMATION_SCHEMA.TABLES
						WHERE TABLE_SCHEMA = 'DB-Project'
						AND   TABLE_NAME   = 'complaint';";
		$tuples = mysqli_query($connect, $get_query);
		$tuples = mysqli_fetch_assoc($tuples);
		$complaint_id = $tuples["AUTO_INCREMENT"] - 1;

		$query_2 = "INSERT INTO `Messages` (`complaint_id`, `sender_name`, `message_content`, `date_sent`) 
					VALUES ('".$complaint_id."', '".$name."', '".$msg."', '".$curr_time."')";
		$query_result = mysqli_query($connect, $query_2);
		header("Location: Home_Page.php");
	}
	
	
?>