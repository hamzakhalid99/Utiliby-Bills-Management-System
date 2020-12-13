<?php 
      include "../DB_Connection/database_connection.php";
      include "../time/curr_time.php";

 ?>
<!doctype html>
<html lang="en">
  <head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    
  </head>
  <body>

    <script>
      function func1(x=4){
      // window.alert(x);
      document.getElementsByClassName("circles").style.display = "none";
      }
    </script>
    <?php 
      session_start();
      if (!isset($_SESSION['logged_in']))
      {
        header("Location: ../index.html");

      }
    ?>
    <div class="wrapper d-flex align-items-stretch">
      <nav id="sidebar" class="bg-dark">
        <div class="p-4 pt-5">
          <a href="#" class="img logo rounded-circle mb-5" style="background-image: url(images/logo2.png); height: 200px; width:200px;"></a>
          <ul class="list-unstyled components mb-5">
              <p class="font-weight-lighter" style="font-size: 30px; text-align: center;"><?php echo $_SESSION['username'] ?></p>
              <hr style="border-width: 2px;border-color:#AAAAAA ;">
            <li>
                <a href="#">Add Service</a>
            </li>
             <li>
                <a href="Remove_Utility.php">Remove Service</a>
            </li>
             <li>
              <a href="Add_Complaints.php">Add Complaint</a>
            </li>
            <li>
              <a href="#">Contact</a>
            </li>
          </ul>

          <!-- <div class="footer">
            <p> --><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
             <!--  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib.com</a> -->
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --><!-- </p> -->
         <!--  </div> -->

        </div>
      </nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="btn btn-primary ">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="Home_Page.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../SignOut/signout.php">Sign Out</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>

        <div class="container-fluid">
          <div class="row">
            <h2 style="font-size: 50px">ADD NEW UTILITY</h2>
           <!--  <div class="container" style="float: right;">
              <h2 style="font-size: 20px;text-align:right;">BALANCE</h2>
              <h2 style="font-size: 30px;text-align:right;">Unlimited</h2>
            </div> -->
          </div>
          <hr style="border-width: 2px;">
        </div>
      
        <div class="container" style="padding-top: 100px; text-align: center">
          <div class='row justify-content-center'>
            <?php 
              $new_utility = $_GET["utility"];
              $package = $_GET["package"];
              $id = $_GET["id"];
              $user_id = $_SESSION['user_id'];

              $amount = "SELECT Utilities.fixed_monthly_price, Utilities.unit_price FROM Utilities WHERE Utilities.utility_id='".$id."';";
              $tuples =  mysqli_fetch_assoc(mysqli_query($connect, $amount));
              $bill_amount = $tuples['fixed_monthly_price'];

              $new_query = "INSERT INTO Registers_For(utility_id, user_id, connection_type, units_consumed, utility_balance, due_date)";
              $new_query .= "VALUES('$id', '$user_id', '$package', 0, -$bill_amount, DATE_ADD('".$curr_time."', INTERVAL 1 MONTH));";
              $query_result = mysqli_query($connect, $new_query);

              if ($query_result)
              {
                echo "<h2 style='font-size:60px;'>ThankYou For Subscribing!</h2>";
                $bill_query = "INSERT INTO invoice(user_id, utility_id, bill_amount, amount_received, bill_due, bill_status, bill_generation_date, date_of_payment)";
                $bill_query .= "VALUES($user_id, '$id', $bill_amount, 0, $bill_amount, 1, '".$curr_time."', NULL);";
                $bill_result = mysqli_query($connect, $bill_query);

                $query2 = "SELECT balance FROM Customer
                WHERE user_id='".$user_id."';";
                $update2 = mysqli_query($connect, $query2);
                $update2 = mysqli_fetch_assoc($update2);
                $balance = $update2['balance'];
                $new_balance = $balance - $bill_amount;
                $balance_query = "UPDATE Customer SET balance='".$new_balance."' WHERE user_id='".$user_id."';";
                $update2 = mysqli_query($connect, $balance_query);
              }
              else
              {
                 echo "<h2  style='font-size:60px;'>You Have Already Subscribed For This Utility</h2>";
              }
            
            ?>
          </div>
          <br>
          <br>
          <br>
          <form method='get' action="Utility_Home_page.php?utility_id=EC">
          <input type="hidden" name="utility_id" value=<?php echo "'".$id."'" ?>>
          <button type = "submit" style = "text-align: center;font-size: 30px;" class="btn btn-primary">Go To Utility Home_Page</button>
          </form>
        </div>
      </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>
