<?php
    #include "generic_layout.php";
    include "../DB_Connection/database_connection.php";

    $id = $_GET['id']; // get id through query string
    $update_q = mysqli_query($connect, "select * from Utilities where utility_id='$id'"); // select query
    $data = mysqli_fetch_array($update_q); // fetch data
    $id = $_GET['id']; // get id through query string
    if (isset($_POST['update'])) // when click on Update button
    {
        $util = $_POST['utility_id'];
        $conn = $_POST['connection_type'];
        $monthly = $_POST['fixed_monthly_price'];
        $unit = $_POST['unit_price'];
        $edit = mysqli_query($connect, "update Utilities set fixed_monthly_price='$monthly', unit_price='$unit',connection_type='$conn' ,utility_id='$util' where utility_id='$id'");

        if ($edit) {
            mysqli_close($connect);
            header("Location:view_update.php"); // redirects to all records page
            exit;
        } else {
            echo "Error updating record"; // display error message if not updated;
        }
    }
?>
<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <h3 style="text-align: center;"> Update Data </h3>

    <form method="POST" style="text-align: center; ">
        Utility id <input type="text" name="utility_id" value="<?php echo $data['utility_id'] ?>" placeholder=" Enter utility id"><br />
        Connection type <input type="text" name="connection_type" value="<?php echo $data['connection_type'] ?>" placeholder=" Enter connection type"><br />
        Fixed monthly price <input type="text" name="fixed_monthly_price" value="<?php echo $data['fixed_monthly_price'] ?>" placeholder=" Enter fixed monthly price"><br />
        Unit Price <input type="text" name="unit_price" value="<?php echo $data['unit_price'] ?>" placeholder=" Enter unit price"><br /> <br>
        <input class="btn btn-primary" type="submit" name="update" value="update">
    </form>
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