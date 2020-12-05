<!DOCTYPE html>
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
                <a href="#" class="img logo rounded-circle mb-5"
                    style="background-image: url(images/logo2.png); height: 200px; width:200px;"></a>
                <ul class="list-unstyled components mb-5">
                    <p class="font-weight-lighter" style="font-size: 30px; text-align: center;">
                        <?php echo $_SESSION['username'] ?></p>
                    <hr style="border-width: 2px;border-color:#AAAAAA ;">
                    <li>
                        <a href="add_util.php"> Add Utility </a>
                    </li>
                    <li>
                        <a href="view_update.php"> View & Update Utility </a>
                    </li>
                    <li>
                        <a href="view_approve.php"> View & Approve Requests </a>
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
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a href="Home_Page.php"><i class="fa fa-home" aria-hidden="true"></i> Home &nbsp; &nbsp; </a>
                            </li>
                            <li class="nav-item">
                                <a href="../"> <i class="fa fa-sign-out"></i> Sign Out &nbsp; &nbsp; </a>
                            </li>
                            <li>
                                <a href=""> <i id="set-cog" class="fa fa-cog"></i> Settings &nbsp; &nbsp; </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container-fluid">
                <div style = "text-align: center">
                    <h2 style="font-size: 40px"> Admin -> <?php echo $_SESSION["name"]?> </h2>
                </div>
                <div class = "my-auto">
                
                <!-- PUT YOUR STFF HERE ... -->
                <!-- THIS MEANS THAT EVERYTHING IN ALL THE FILES SHOULD BE PUT HERE ONCE THIS FILE IS INCLUDED -->
                <!-- EVERYTHING AT THE END OF THIS FILE GOES AT THE END OF OTHER FILES (WHERE THIS FILE IS INCLUDED) -->
                
                
                <!-- </div> I AM THE GUY ... IN SOME OTHER FILE ... I MUST NOT END THE FILE HERE ... MY JOB IS TO BE DONE SOME PLACE ELSE
            </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html> -->
