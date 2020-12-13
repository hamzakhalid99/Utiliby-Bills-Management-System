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
          $complaint_id = $_GET["complaint_id"];
          $user_id = $_SESSION['user_id'];
          $name = $_SESSION['name'];
          $query="SELECT Utilities.utility_name
          FROM Utilities
          Where utility_id='".$utility_id."';";
          $tuples = mysqli_query($connect,$query); 
          while($one_row = mysqli_fetch_assoc($tuples))
          {
            $utility_name = $one_row["utility_name"];
            } 
          $query="SELECT *
          FROM complaint
          Where complaint_id='".$complaint_id."';";
          $tuples = mysqli_query($connect,$query); 
          while($one_row = mysqli_fetch_assoc($tuples))
          {
            $status = $one_row["complaint_status"];
            $date = $one_row['registeration_date'];
            $pay_date = $one_row['resolution_date'];
            $escalation = $one_row['escalation_status'];
            } 
        ?> 
        <div class="container-fluid">
          <div class="row">
            <h2 style="font-size: 50px"><?php echo $utility_name ?></h2>
          </div>
          <hr style="border-width: 2px;">
        </div>
        <div class="row bg-dark " style="border-radius: 10px;box-shadow: 0 5px 10px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.0);">
          <div class='col'>
            <h4 class="mb-2 font-weight-light text-light" style="text-align: center;">Complaint No:</h4>
            <h4 class="mb-2 font-weight-light text-light" style="text-align: center;"><?php echo $complaint_id; ?></h4>
          </div>
          <div class='col'>
            <h4 class="mb-2 font-weight-light text-light" style="text-align: center;">Status:</h4>
            <h4 class="mb-2 font-weight-light text-light" style="text-align: center;"> <?php echo $status; ?></h4>
          </div>
          <div class='col'>
            <h4 class="mb-2 font-weight-light text-light" style="text-align: center;">Date Initiated: </h4>
            <h4 class="mb-2 font-weight-light text-light" style="text-align: center;"><?php echo $date; ?></h4>
          </div>
          <div class='col'>
            <h4 class="mb-2 font-weight-light text-light" style="text-align: center;">Date Resolved: </h4>
            <h4 class="mb-2 font-weight-light text-light" style="text-align: center;"><?php echo $pay_date; ?></h4>
          </div>
          <div class='col'>
            <h4 class="mb-2 font-weight-light text-light" style="text-align: center;">Escalation Status: </h4>
            <h4 class="mb-2 font-weight-light text-light" style="text-align: center;"><?php echo $escalation; ?></h4>
          </div>
        </div>
        <div style="height:450px;overflow-y: scroll;">
        <?php 
          $query = "SELECT * FROM Messages WHERE complaint_id='".$complaint_id."'";
          $tuples = mysqli_query($connect,$query); 
          while($one_row = mysqli_fetch_assoc($tuples))
          {
            $msg = $one_row["message_content"];
            $sender = $one_row["sender_name"];
            $date = $one_row["date_sent"];
            if ($sender == $name)
            {
               echo '<div class=" container bg-dark text-light custom-header-me">'."$sender\t\tat\t\t$date".'</div>
                <div class=" container bg-secondary text-light custom-msg-me">'.$msg.'</div>';
            }
            else
            {
               echo '<div class=" container bg-dark text-light custom-header-him">'."$sender\t\t$date".'</div>
                <div class=" container bg-secondary text-light custom-msg-him">'.$msg.'</div>';
            }
          }
          ?>
        </div>
        <?php 
              if ($status == 0)
              {

              }
              else
              {
                echo '<br>
                    <form method = "post" action="New_Complaint.php">
                        <input type="hidden" name="sender" value="'.$name.'">
                        <input type="hidden" name="complaint_id" value="'.$complaint_id.'">
                        <input type="hidden" name="util_ID" value="'.$utility_id.'">
                        <div class="form-row">
                            <div class="form-group col">
                                <input class="form-control form-control-lg" type = "text" placeholder = "Enter Message" name = "msg"> 
                            </div>
                        <button class = "btn btn-primary form-group col" style="font-size: 20px; text-align: center;max-width:100px;"type = "submit" name = "send_form"> send </button>
                    </form>
                    <form method="post" action="Escalate_Complaint.php">
                        <input type="hidden" name="complaint_id" value="'.$complaint_id.'">
                        <button class = "btn btn-primary form-group col" style="margin-left: 5px;font-size: 20px; text-align: center;max-width:100px;min-height: 50px;"type = "submit" name = "send_form">Escalate</button></form>
                    </div>
                    </form>';
              }
      ?>
      </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>