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
                <a href="#">Add Service</a>
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
            <h2 style="font-size: 50px">Gas</h2>
            <div class="container" style="float: right;">
              <h2 style="font-size: 20px;text-align:right;">Bill Due</h2>
              <h2 style="font-size: 30px;text-align:right;"><?php include "../DB_Connection/database_connection.php";
                    $price="SELECT fixed_monthly_price FROM utilities where utility_id='GR'";
                    $price = mysqli_query($connect,$price); 
                    while($one_row = mysqli_fetch_assoc($price))
                    {
                        echo $one_row["fixed_monthly_price"];
                    } ?> </h2>
            </div>
          </div>
          <hr style="border-width: 2px;">
        </div>
        
          <table class="table" style="font-size: 20px;">
            <tr>
              <th class="font-weight-light">Name</th>
              <th class="font-weight-light"><?php echo $_SESSION['name'] ?></th>
            </tr>
             <tr>
              <th class="font-weight-light">ADDRESS</th>
              <th class="font-weight-light"><?php echo $_SESSION['address'] ?></th>
            </tr>
             </tr>
             <tr>
              <th class="font-weight-light">Due Date</th>
              <th class="font-weight-light">Due Date (we will insert this after billing is finalised)</th>
            </tr>
          </table>
          <h2 style="font-size: 15px;text-align:right;">In case of any discrepancies, please contact us at 0900-78601</h2>
      

        </div>
      </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>
