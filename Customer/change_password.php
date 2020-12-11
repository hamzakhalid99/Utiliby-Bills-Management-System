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
    <?php session_start(); include "../DB_Connection/database_connection.php"; ?>
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
                    <li>
                        <a href="viewbill.php"> View & Update Bills </a>
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
                                <a href="change_password.php"> <i id="set-cog" class="fa fa-cog"></i> Change Password &nbsp; &nbsp; </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container-fluid">
                <div style = "text-align: center">
                    <h2 style="font-size: 40px"> <?php echo $_SESSION["name"]?> </h2>
                </div>
                <div class = "my-auto">


<h2 style = "text-align: center; "> Change Your Password </h2>

<div>
    <form style = "text-align: center; " method = "post">
        <input type = "password" name = "old_pass" placeholder = "Confirm Old Password"> <br> <br>
        <input type = "password" name = "new_pass" placeholder = "Create New Password"> <br> <br>
        <input type = "password" name = "again_new_pass" placeholder = "Confirm New Password"> <br> <br>
        <input type = "submit" class = "btn btn-primary" name = "Process" value = "Change Password" >
    </form>
</div>

<?php 
    if (isset($_POST["Process"]))
    {
        if (!empty($_POST["old_pass"]) && !empty($_POST["new_pass"]) && !empty($_POST["again_new_pass"]))
        {
            $id = $_SESSION["user_id"];
            $old_pass = $_POST["old_pass"];
            $select = "SELECT  password FROM User WHERE user_id = $id";
            $select_result = mysqli_query($connect, $select);

            if ($select_result)
            {
                while ($pass = mysqli_fetch_assoc($select_result))
                {
                    $DB_hashed_pass = $pass["password"];
                }
                $hash_format = "$2y$10$"; // Specific format for hashing
                $salt = "m1ni7eisu0avrcpzjlqOw1"; // Salt needs to be 22 characters long (VERY, VERY PRECISELY)
                $concatenate = $hash_format . $salt;
                $obtained_hashed_password = crypt($old_pass, $concatenate); // Encryption process based on the user input and hashing format
            }

            if ($DB_hashed_pass == $obtained_hashed_password)
            {
                $new_pass = $_POST["new_pass"];
            
                if(!preg_match ('/[^A-Za-z0-9]+/', $new_pass)) // Alpha Numeric Check with special characters
                    echo("<h2 style = 'color: red; text-align: center;'> ERR_PASSWORD_NOT_ALPHANUMERIC_WITH_SPECIAL_CHARACTERS </h2>");
                else if (strlen($new_pass) < 8) // Length check
                    echo("<h2 style = 'color: red; text-align: center;'> ERR_PASSWORD_TOO_SHORT </h2>");
                else // if new password does not have any issues and it is totally acceptable ... go ahead and check if the user added new password properly for the second time
                {
                    $confirmation = $_POST["again_new_pass"];
                    if ($confirmation == $new_pass)
                    {
                        $hash_format = "$2y$10$"; // Specific format for hashing
                        $salt = "m1ni7eisu0avrcpzjlqOw1"; // Salt needs to be 22 characters long (VERY, VERY PRECISELY)
                        $concatenate = $hash_format . $salt;
                        $new_hash = crypt($new_pass, $concatenate); // Encryption process based on the user input and hashing format
                        
                        $update_query = "UPDATE User SET password = '$new_hash' WHERE user_id = $id";
                        $update_result = mysqli_query($connect, $update_query);

                        if ($update_result)
                            echo("<h2 style = 'color: green; text-align: center;'> PASSWORD_CHANGED_SUCCESSFULLY </h2>");
                        else 
                            echo("<h2 style = 'color: red; text-align: center;'> ERR_UPDATION_FAILED </h2>");
                    }
                    else 
                        echo("<h2 style = 'color: red; text-align: center;'> ERR_NEW_PASSWORD_NOT_MATCHED </h2>");
                }
            }
            else
                echo("<h2 style = 'color: red; text-align: center;'> ERR_WRONG_OLD_PASSWORD </h2>");
        }
        else
            echo("<h2 style = 'color: red; text-align: center;'> ERR_FORM_NOT_COMPLETELY_FILLED </h2>");
    }
?>
