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
	<?php
		$time_query = "SELECT * FROM Time;";
		$tuples = mysqli_query($connect,$time_query); 
        $one_row = mysqli_fetch_assoc($tuples);
        $curr_time = $one_row["curr_date"];
		if (isset($_POST["inc"]))
		{
			$inc = $_POST['inc'];
			if ($inc == "day")
			{
				$query = "UPDATE Time SET curr_date=DATE_ADD('".$curr_time."', INTERVAL 1 DAY);";
			}
			else if ($inc == "month")
			{
				$query = "UPDATE Time SET curr_date=DATE_ADD('".$curr_time."', INTERVAL 1 MONTH);";

			}
			else if ($inc == "year")
			{
				$query = "UPDATE Time SET curr_date=DATE_ADD('".$curr_time."', INTERVAL 1 Year);";

			}
			$tuples = mysqli_query($connect,$query);
			$time_query = "SELECT * FROM Time;";
			$tuples = mysqli_query($connect,$time_query); 
	        $one_row = mysqli_fetch_assoc($tuples);
	        $curr_time = $one_row["curr_date"];
			unset($_POST['inc']);

		}
	?>
		<div class="container-fluid">
	    <div class="row">
	        <h2 style="text-align: center; ">Time Master</h2>
	    </div>
		<hr style="border-width: 2px;">
		</div>
	<br><br>
	<div class="wrapper d-flex align-items-stretch justify-content-center">
	<div class="form-row">
		<div class='form-group col'>
		<form method='post' action="chronos.php">
  		<input type="hidden" name="inc" value="day">
  		<button type = "submit" style = "text-align: center;padding: 20px;min-width: 300px;font-size: 30px;" class="btn btn-primary">Next Day</button>
      	</form>
      </div>
      <div class='form-group col'>
		<form method='post' action="chronos.php">
  		<input type="hidden" name="inc" value="month">
  		<button type = "submit" style = "text-align: center;padding: 20px;min-width: 300px;font-size: 30px;" class="btn btn-primary">Next Month</button>
      	</form>
      </div>
      <div class='form-group col'>
		<form method='post' action="chronos.php">
  		<input type="hidden" name="inc" value="year">
  		<button type = "submit" style = "text-align: center;padding: 20px;min-width: 300px;font-size: 30px;" class="btn btn-primary">Next Year</button>
      	</form>
      </div>
     </div>
	</div>
	<br><br>
	<h2 style="text-align: center; font-size: 50px;">Current time: <?php echo $curr_time; ?></h2>
<div class= 'row'>
 <table class="table" style="font-size: 20px;">
           <thead class="thead-dark">
          <tr>
            <th class='font-weight-light'>User ID</th>
            <th class='font-weight-light'>Utility ID</th>
            <th class='font-weight-light'>Name</th>
            <th class='font-weight-light'>Due Date</th>
            <th class='font-weight-light'>Days Overdue</th>
            <th class='font-weight-light'>Paid</th>
          </tr>
        </thead>
        <tbody>
<?php
	$bills_due = "SELECT User.user_id, Registers_For.utility_id, User.name, Registers_For.due_date, Registers_For.days_overdue 
                FROM `Registers_For` INNER JOIN User USING(user_id) 
                WHERE Registers_For.due_date < '".$curr_time."';";
	$tuples = mysqli_query($connect,$bills_due); 

    while ($one_row = mysqli_fetch_assoc($tuples))
    {
    	$user_id = $one_row["user_id"];
      $utility_id = $one_row["utility_id"];
      $name = $one_row["name"];
      $due = $one_row["due_date"];
      if ($due <= $curr_time)
      {
        $d1 = date_create($due);
        $d2 = date_create($curr_time);
        $days_overdue = date_diff($d1, $d2)->days;
        
        $check_payment = "SELECT MAX(invoice_id), bill_status FROM `invoice` WHERE user_id=".$user_id." AND utility_id='".$utility_id."' AND bill_status=b'1' GROUP BY bill_status";
        $status = mysqli_query($connect,$check_payment);
        $status = mysqli_fetch_assoc($status);
        if ($status['bill_status'])
        {

        }
        else
        {
          echo $status['MAX(invoice_id)'];
          echo "hello";
          //getting prices
          $amount = "SELECT Utilities.fixed_monthly_price, Utilities.unit_price FROM Utilities WHERE Utilities.utility_id='".$utility_id."';";
          $tuples =  mysqli_fetch_assoc(mysqli_query($connect, $amount));
          if ($tuples)
          {
            echo "1";
          }
          $bill_amount = $tuples['fixed_monthly_price'];

          // //adding invoice
          $bill_query = "INSERT INTO invoice(user_id, utility_id, bill_amount, amount_received, bill_due, bill_status, bill_generation_date, date_of_payment)";
          $bill_query .= "VALUES($user_id, '$utility_id', $bill_amount, 0, $bill_amount, 1, '".$due."', NULL);";
          $bill_result = mysqli_query($connect, $bill_query);
          if ($bill_result)
          {
            echo "2";
          }


          $query2 = "SELECT * FROM Registers_For INNER JOIN (SELECT * FROM User INNER JOIN Customer USING(user_id)) AS T USING(user_id)
          WHERE user_id='".$user_id."' AND utility_id='".$utility_id."';";
          $update2 = mysqli_query($connect, $query2);
          $update2 = mysqli_fetch_assoc($update2);
          $balance = $update2['balance'];
          $due_date = $update2['due_date'];
          $util_balance = $update2['utility_balance'];
          $new_balance = $balance - $bill_amount;
          $new_util_balance = $new_util_balance - $bill_amount;

          $balance_query = "UPDATE Customer SET balance='".$new_balance."' WHERE user_id='".$user_id."';";
          $util_balance_query = "UPDATE Registers_For 
                SET utility_balance='".$new_util_balance."', days_overdue='0', due_date=DATE_ADD('".$due."', INTERVAL 1 MONTH)
              WHERE user_id='".$user_id."' AND utility_id='".$utility_id."';";
          $update2 = mysqli_query($connect, $balance_query);
          $update2 = mysqli_query($connect, $util_balance_query);
        }
      }
     
      echo 
      "<tr>
      <td class='font-weight-light'>".$user_id."</td>
      <td class='font-weight-light'>".$utility_id."</td>
      <td class='font-weight-light'>".$name."</td>
      <td class='font-weight-light'>".$due."</td>
      <td class='font-weight-light'>".$days_overdue."</td>
      <td class='font-weight-light'>".$status['bill_status']."</td>
      </tr>";
    }
?>
</tbody>
</table>
</div>
</div>
</body>
 <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>