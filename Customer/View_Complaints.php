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
              <a href="Add_Complaints.php">Add Complaint</a>
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

        <?php
          $utility_id = $_GET["utility_id"];
          $user_id = $_SESSION['user_id'];
          $query="SELECT Utilities.utility_name
          FROM Utilities
          Where utility_id='".$utility_id."';";
          $tuples = mysqli_query($connect,$query); 
          while($one_row = mysqli_fetch_assoc($tuples))
          {
            $utility_name = $one_row["utility_name"];
            } 
        ?> 
        <div class="container-fluid">
          <div class="row">
            <h2 style="font-size: 50px"><?php echo $utility_name ?></h2>
          </div>
          <hr style="border-width: 2px;">
        </div>
        <h2 class="mb-4 ">All Complaints</h2>
        <hr style="border-width: 2px;">
        <div class="container-fluid">
          <table class="table" style="font-size: 20px">
            <thead class="thead-dark">
            <tr>
              <th class='font-weight-light'>Complaint ID</th>
              <th class='font-weight-light'>Status</th>
              <th class='font-weight-light'>Type</th>
              <th class='font-weight-light'>Date</th>
              <th class='font-weight-light'>Resolution Date</th>
              <th class='font-weight-light'>Escalation</th>
              <th class='font-weight-light'>View</th>
            </tr>
            </thead>
            <tbody>
              <?php
                $user_id = $_SESSION['user_id'];
                $utility_id = $_GET['utility_id'];
                $query = "SELECT * FROM complaint WHERE complaint.user_id='".$user_id."';";
                $tuples = mysqli_query($connect,$query); 
                while($one_row = mysqli_fetch_assoc($tuples))
                {
                  $complaint_id = $one_row["complaint_id"];
                  $due = $one_row["complaint_status"];
                  $status = $one_row["complaint_desc"];
                  $gen_date = $one_row["registeration_date"];
                  $recieved = $one_row["resolution_date"];
                  $pay_date = $one_row["escalation_status"];
                  echo 
                  "<tr>
                  <td class='font-weight-light'>".$complaint_id."</td>
                  <td class='font-weight-light'>".$due."</td>
                  <td class='font-weight-light'>".$status."</td>
                  <td class='font-weight-light'>".$gen_date."</td>
                  <td class='font-weight-light'>".$recieved."</td>
                  <td class='font-weight-light'>".$pay_date."</td>
                  <td class='font-weight-light'><a href='View_Complaint.php?complaint_id=".$complaint_id."&utility_id=".$utility_id."'>view</a></td>
                  </tr>";


                } 
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>