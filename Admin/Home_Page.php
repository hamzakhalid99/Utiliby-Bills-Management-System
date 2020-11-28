<?php 
  // Hello. How are you?
?>

<!doctype html>
<html lang="en">
  <head>
  	<title> Admin </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
  <body>
		<?php session_start() ?>
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar" class="bg-dark">
				<div class="p-4 pt-5">
		  		<a href="#" class="img logo rounded-circle mb-5" style="background-image: url(images/logo2.png); height: 200px; width:200px;"></a>
	        <ul class="list-unstyled components mb-5">
              <p class="font-weight-lighter" style="font-size: 30px; text-align: center;"><?php echo $_SESSION['username'] ?></p>
              <hr style="border-width: 2px;border-color:#AAAAAA ;">
	          <li>
	              <a href="add_util.php"> Add Utility </a>
	          </li>
             <li>
              <a href="view_update.php"> View & Update Utility </a>
            </li>
          </ul>
            <!-- <select name="cars" id="cars">
              <option selected disabled hidden> Settings </option>
              <option value="volvo">Volvo</option>
              <option value="saab">Saab</option>
              <option value="mercedes">Mercedes</option>
              <option value="audi">Audi</option>
          </select> -->

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
                    <a href="#"><i class="fa fa-home" aria-hidden="true"></i> Home &nbsp; &nbsp; </a>
                </li>
                <li class="nav-item">
                    <a href="../"> <i class="fa fa-sign-out"></i> Sign Out &nbsp; &nbsp; </a>
                </li>
                <li>
                  <a href=""> <i id = "set-cog" class="fa fa-cog"></i> Settings &nbsp; &nbsp; </a>
                </li>
              </ul>
            </div>
          </div>
        </nav>

      <!-- 
        <script>
          $("#set-cog").hover(function () {
            console.log("Hover");
          });
        </script>
      -->

        <div class="container-fluid">
          <div class="row">
            <h2 style="font-size: 40px">ADMIN HOME PAGE</h2>
            <div class="container" style="float: right; padding-left: 0px">
              <h2 style="font-size: 20px;text-align:right;">BALANCE</h2>
              <h2 style="font-size: 30px;text-align:right;">Unlimited</h2>
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
            <a href = "#">
              <div class='col-sm-5 custom-column-spacing'>
                <div class="container myClass bg-dark custom-image-circle" style=" background-image: url(pics/drop.svg);"></div>
              </div>
            </a>
            <a href = "#">
              <div class='col-sm-5 custom-column-spacing'>
                <div class="container myClass bg-dark custom-image-circle" style=" background-image: url(pics/flash.svg);"></div>
              </div>
            </a>
           <a href = "#">
              <div class='col-sm-5 custom-column-spacing'>
                <div class="container bg-dark custom-image-circle myClass" style=" background-image: url(pics/flash.svg);"></div>
              </div>
            </a>
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

<style>

  .myClass {
    height: 200px;
    width: 200px;
  }

</style>
