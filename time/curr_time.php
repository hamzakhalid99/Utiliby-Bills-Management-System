<?php
	include "../DB_Connection/database_connection.php";
	$time_query = "SELECT * FROM Time;";
	$tuples = mysqli_query($connect,$time_query); 
	$one_row = mysqli_fetch_assoc($tuples);
	$curr_time = $one_row["curr_date"];
?>