<!DOCTYPE html>
<html lang = "en">
<head>
	<title> Admin / Add Utility </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
</head>

<body>
    <h2 style = "text-align: center; "> Add New Utility </h2>
    <div style = "text-align: center; width: 100%">
        <form method = "post">
            <input type = "text" placeholder = "Utility Name" name = "util_name"> <br>
            <input type = "text" placeholder = "Monthly Price" name = "util_mon_price"> <br>
            <input type = "text" placeholder = "Unit Price" name = "util_uni_price"> <br>
            <select name = "options">
                <option selected disabled value hidden = "connection_1"> Choose Connection Type </option>
                <option> Residential </option>
                <option> Commercial </option>
                <option> Industrial </option>
            </select> <br>
            <button type = "submit" name = "send_form"> Submit </button>
        </form>
    </div>
</body>
</html>

<?php 
    include "../DB_Connection/database_connection.php";
    if (isset($_POST["send_form"]))
    {
        if (!empty($_POST["util_name"]) && !empty($_POST["util_mon_price"]) && !empty($_POST["util_uni_price"]) && !empty($_POST["options"]))
        {
            $name = $_POST["util_name"];
            $mon_price = $_POST["util_mon_price"];
            $uni_price = $_POST["util_uni_price"];
            $connection_type = $_POST["options"];
            
            $write_query = "INSERT INTO Utilities(connection_type, utility_name, fixed_monthly_price, unit_price)";
            $write_query .= "VALUES('$connection_type', '$name', '$mon_price', '$uni_price')";
            $write_query_result = mysqli_query($connect, $write_query);
            
            if (!$write_query_result)
                die("<h2 style = 'color: red; text-align: center;'> ERR_WRITING_FAILED </h2>");
            else 
                header("Location: Home_Page.php");
        }
        else 
            die("<h2 style = 'color: red; text-align: center;'> ERR_FORM_NOT_COMPLETELY_FILLED </h2>");
    }
?>