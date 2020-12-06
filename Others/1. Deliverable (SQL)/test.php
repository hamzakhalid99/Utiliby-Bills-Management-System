<!DOCTYPE html>
<html>
    <head>
        <title> Test.php </title>
    </head>
    <body>
        <?php
            $counter = 0;
            $database_connection = mysqli_connect("localhost", "root", "", "DB-Project"); // default username and password (root, "")
            if (!$database_connection)
                die("ERR_CONNECTION_FAILED"); // Print a message and exit from the PHP script
                
            $create_query = "create table invoice(
                invoice_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                user_id INT UNSIGNED,
                utility_id INT UNSIGNED,
                bill_amount FLOAT,
                amount_received float,
                bill_due float,
                bill_status BIT,
                date_of_payment DATE,
                FOREIGN KEY (utility_id) REFERENCES Utilities (utility_id) ON DELETE SET NULL,
                FOREIGN KEY (user_id) REFERENCES User (user_id) ON DELETE SET NULL
            );"; ////////////////////////////////// ADIL ADD YOUR QUERY HERE IN THE STRING... AND RUN THE FILE IN THE BROWSER ONLY ONCE
            $create_query_successful = mysqli_query($database_connection, $create_query);
            if ($create_query_successful)
                echo "Created\n";
            else
            {
                echo mysqli_error($database_connection);
            }
        ?>
    </body>
</html>
