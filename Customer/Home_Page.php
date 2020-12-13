<?php include "../DB_Connection/database_connection.php"; ?>
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
		<?php 
      session_start();
      if (!isset($_SESSION['logged_in']))
      {
        header("Location: /DB/index.html");

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
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../SignOut/signout.php">Sign Out</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <?php
          $user_id = $_SESSION['user_id'];
          $query="SELECT balance FROM Customer Where user_id='".$user_id."';";
          $tuples = mysqli_query($connect,$query); 
          $one_row = mysqli_fetch_assoc($tuples);
          $balance = $one_row["balance"];
        ?> 
        <div class="container-fluid">
          <div class="row">
            <h2 style="font-size: 50px">MY ACCOUNT</h2>
            <div class="container" style="float: right;">
              <h2 style="font-size: 20px;text-align:right;">BALANCE</h2>
              <h2 style="font-size: 30px;text-align:right;">Rs <?php echo $balance; ?></h2>
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
              <th class="font-weight-light">EMAIL</th>
              <th class="font-weight-light"><?php echo $_SESSION['email_id'] ?></th>
            </tr>
             <tr>
              <th class="font-weight-light">CNIC</th>
              <th class="font-weight-light"><?php echo $_SESSION['cnic'] ?></th>
            </tr>
             <tr>
              <th class="font-weight-light">ADDRESS</th>
              <th class="font-weight-light"><?php echo $_SESSION['address'] ?></th>
            </tr>
             <tr>
              <th class="font-weight-light">CONTACT NO</th>
              <th class="font-weight-light"><?php echo $_SESSION['contact_number'] ?></th>
            </tr>
          </table>
      

        <h2 class="mb-4 ">Services</h2>
        <hr style="border-width: 2px;">
        <div class="container" style="padding-top: 50px">
          <div class='row justify-content-center'>
            <?php 
              $user_id = $_SESSION['user_id'];
              $query = "SELECT Utilities.utility_name, Utilities.image, Utilities.utility_id
                        FROM Registers_For INNER JOIN Utilities ON Utilities.utility_id=Registers_For.utility_id 
                        WHERE Registers_For.user_id=$user_id;";
              $query_result = mysqli_query($connect, $query);
              $count = mysqli_num_rows($query_result);
              if ($count== 0)
              {
                echo '<h2 class="mb-4" id="title">You Have Not Subscribed To Any Service yet</h2>';
              }
              else
              {
                for ($i = 0;$i < $count;$i++)
                {

                  $tuples = mysqli_fetch_assoc($query_result);
                  $path = $tuples['image'];
                  $util_name = $tuples['utility_name'];
                  $id = $tuples["utility_id"];
                   echo "<a href='Utility_Home_page.php?utility_id=".$id."'><div class='col-sm-5 custom-column-spacing'><div class='container bg-dark custom-image-circle' style=' background-image: url(pics/" . $path . ");'></div></div></a>";

                }

              }
              
              
              ?>
          </div>
        </div>
      </div>
		</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>