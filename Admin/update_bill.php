<?php
    #include "generic_layout.php";
    include "../DB_Connection/database_connection.php";

    $id = $_GET['id']; // get id through query string
    $update_q = mysqli_query($connect, "select * from invoice where invoice_id='$id'"); // select query
    $data = mysqli_fetch_array($update_q); // fetch data
    $id = $_GET['id']; // get id through query string
    if (isset($_POST['Update'])) // when click on Update button
    {
        $invoice = $_POST['invoice_id'];
        $util = $_POST['utility_id'];
        $bill = $_POST['bill_amount'];
        $received = $_POST['amount_received'];
        $due = $_POST['bill_due'];
        // $status = $_POST['bill_status'];
        $payment_date = $_POST['date_of_payment'];
        $gen_date = $_POST['bill_generation_date'];
        $edit = mysqli_query($connect, "update invoice set bill_generation_date='$gen_date', date_of_payment='$payment_date',
        bill_due='$due',amount_received='$received',bill_amount='$bill',utility_id='$util',invoice_id='$invoice' where invoice_id='$id'");

        if ($edit) {
            mysqli_close($connect);
            header("Location:viewbill.php"); // redirects to all records page
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
    <h3 style="text-align: center;"> Update bill </h3>

    <form method="POST" style="text-align: center; ">
        Invoice id <input type="text" name="invoice_id" value="<?php echo $data['invoice_id'] ?>" placeholder=" Enter invoice id"><br />
        Utility id <input type="text" name="utility_id" value="<?php echo $data['utility_id'] ?>" placeholder=" Enter utility id"><br />
        Bill amount <input type="text" name="bill_amount" value="<?php echo $data['bill_amount'] ?>" placeholder=" Enter bill amount"><br />
        Amount received <input type="text" name="amount_received" value="<?php echo $data['amount_received'] ?>" placeholder=" Enter amount received"><br />
        Bill due <input type="text" name="bill_due" value="<?php echo $data['bill_due'] ?>" placeholder=" Enter bill due"><br /> <br>
        <!-- Bill status <input type="text" name="bill_status" value="<?php echo $data['bill_status'] ?>" placeholder=" Enter bill status"><br /> -->
        Bill Generation date <input type="text" name="bill_generation_date" value="<?php echo $data['bill_generation_date'] ?>" placeholder=" Enter date"><br />
        Payment date <input type="text" name="date_of_payment" value="<?php echo $data['date_of_payment'] ?>" placeholder=" Enter date"><br />
        <input class="btn btn-primary" type="submit" name="Update" value="Update">
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