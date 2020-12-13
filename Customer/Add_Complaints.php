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
            <h2 style="font-size: 50px">ADD COMPLAINT</h2>
          </div>
          <hr style="border-width: 2px;">
        </div>
         <form method = "post" action="New_Complaint.php">
            <div class="form-row">
                <div class="form-group col">
                    <input class="form-control form-control-lg" type = "text" placeholder = "Utility ID" name = "util_ID"> 
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                <select class="form-control form-control-lg" name = "complaint_type">
                    <option selected disabled value hidden = "connection_1"> Choose Complaint Type </option>
                    <option> Installation </option>
                    <option> Service </option>
                    <option> Personnel </option>
                    <option> Other </option>
                </select>
                </div>
            </div>
            <div class="form-row">  
                <div class="form-group col">      
                    <textarea style="min-height: 100px;" class="form-control form-control-lg" placeholder = "Enter Complaint" name = "msg"></textarea>
                </div>
            </div>
            <button class = "btn btn-primary" style="font-size: 20px; text-align: center;"type = "submit" name = "send_form"> Submit </button>
        </form>
        
      </div>
		</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>
