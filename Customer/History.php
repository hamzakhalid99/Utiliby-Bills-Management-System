 <?php include "../DB_Connection/database_connection.php";?>
<!doctype html>
<html lang="en">
  <head>
    <title>Sidebar 01</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <?php 
      session_start();
      if (!isset($_SESSION['cnic']))
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
                <a href="Add_Utility.php">Add Service</a>
            </li>
             <li>
                <a href="Remove_Utility.php">Remove Service</a>
            </li>
             <li>
              <a href="#">Add Complaint</a>
            </li>
            <li>
              <a href="#">Contact</a>
            </li>
          </ul>
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
                    <a class="nav-link" href="../Customer/Home_Page.php">Home</a>
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
            <h2 style="font-size: 50px">Electricity</h2>
          </div>
          <hr style="border-width: 2px;">
        </div>
        <h2 class="mb-4 ">Billing History</h2>
        <hr style="border-width: 2px;">
        <table class="table" style="font-size: 20px;">
          <thead class="thead-dark">
          <tr>
            <th class='font-weight-light'>Invoice ID</th>
            <th class='font-weight-light'>Bill Ammount</th>
            <th class='font-weight-light'>Amount Recieved</th>
            <th class='font-weight-light'>Due</th>
            <th class='font-weight-light'>Status</th>
            <th class='font-weight-light'>Generated</th>
            <th class='font-weight-light'>Date Of Payment</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $user_id = $_SESSION['user_id'];
            $utility_id = $_GET['utility_id'];
            $query = "SELECT * FROM invoice WHERE invoice.user_id='".$user_id."' AND invoice.utility_id='".$utility_id."';";
            $tuples = mysqli_query($connect,$query); 
            while($one_row = mysqli_fetch_assoc($tuples))
            {
              $invoice_id = $one_row["invoice_id"];
              $bill_amount = $one_row["bill_amount"];
              $recieved = $one_row["amount_received"];
              $due = $one_row["bill_due"];
              $status = $one_row["bill_status"];
              $gen_date = $one_row["bill_generation_date"];
              $pay_date = $one_row["date_of_payment"];
              echo 
              "<tr>
              <th class='font-weight-light'>".$invoice_id."</th>
              <th class='font-weight-light'>".$bill_amount."</th>
              <th class='font-weight-light'>".$recieved."</th>
              <th class='font-weight-light'>".$due."</th>
              <th class='font-weight-light'>".$status."</th>
              <th class='font-weight-light'>".$gen_date."</th>
              <th class='font-weight-light'>".$pay_date."</th>
              </tr>";


            } 
          ?>
        </tbody>
        </table>
      </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>