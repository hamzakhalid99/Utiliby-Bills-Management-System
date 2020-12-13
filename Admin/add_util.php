<?php 
    include "generic_layout.php";
?>
<!DOCTYPE html>
<html lang = "en">
<head>
	<title> Admin / Add Utility </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
</head>

<body>
    <div class="container-fluid">
    <div class="row">
        <h2 style="text-align: center; ">Add New Utility</h2>
    </div>
    <hr style="border-width: 2px;">
    <br>
        <form method = "post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col">
                    <input class="form-control form-control-lg" type = "text" placeholder = "Utility ID" name = "util_ID"> 
                </div>
                <div class="form-group col">
                    <input class="form-control form-control-lg" type = "text" placeholder = "Utility Name" name = "util_name">
                </div>
            </div>
             <label style="font-size: 20px;">Enter Prices</label>
            <div class="form-row">  
                <div class="form-group col">      
                    <input class="form-control form-control-lg" type = "text" placeholder = "Monthly Price" name = "util_mon_price">
                </div>
                <div class="form-group col">
                    <input class="form-control form-control-lg" type = "text" placeholder = "Unit Price" name = "util_uni_price">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                <select class="form-control form-control-lg" name = "options">
                    <option selected disabled value hidden = "connection_1"> Choose Connection Type </option>
                    <option> Residential </option>
                    <option> Commercial </option>
                    <option> Industrial </option>
                </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <div class="custom-file form-control-lg">
                    <input  class = "custom-file-input" type = "file" name = "image" id="image">
                    <label class="custom-file-label" for="image">Choose logo file</label>
                    </div>
                </div>

            </div>
            <button class = "btn btn-primary" style="font-size: 20px; text-align: center;"type = "submit" name = "send_form"> Submit </button>
        </form>
</body>
</html>

<?php 
    include "../DB_Connection/database_connection.php";
    if (isset($_POST["send_form"]))
    {
        if (!empty($_POST["util_ID"]) && !empty($_POST["util_name"]) && !empty($_POST["util_mon_price"]) && !empty($_POST["util_uni_price"]) && !empty($_POST["options"]))
        {
            $id = $_POST["util_ID"];
            $overlap_query = "SELECT * FROM Utilities WHERE utility_id = '$id'";
            $result = mysqli_query($connect, $overlap_query);
            $rows = mysqli_num_rows($result);
            if ($rows > 1)
            {
                die("<h2 style = 'color: red; text-align: center;'> ERR_UTILITY_EXISTS </h2>");
            }
            else 
            {
                $name = $_POST["util_name"];
                $mon_price = $_POST["util_mon_price"];
                $uni_price = $_POST["util_uni_price"];
                $connection_type = $_POST["options"];
                $image_temp = $_FILES["image"]["name"];
                $image = $_FILES["image"]["name"];

                move_uploaded_file($image, "pics/$image");

                $write_query = "INSERT INTO Utilities(utility_id, connection_type, utility_name, fixed_monthly_price, unit_price, image)";
                $write_query .= "VALUES('$id', '$connection_type', '$name', '$mon_price', '$uni_price', '$image')";
                $write_query_result = mysqli_query($connect, $write_query);
                
                if (!$write_query_result)
                {
                    die("<h2 style = 'color: red; text-align: center;'> ERR_WRITING_FAILED </h2>");
                }
                else 
                    header("Location: Home_Page.php");
            }
            
        }
        else 
            die("<h2 style = 'color: red; text-align: center;'> ERR_FORM_NOT_COMPLETELY_FILLED </h2>");
    }
?>
<script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
