<!DOCTYPE html>
<html>
    <head>
        <title> CS-340 </title>
    </head>
    <body>
        <?php
            $counter = 0;
            $database_connection = mysqli_connect("localhost", "root", "", "DB-Project"); // default username and password (root, "")
            if (!$database_connection)
                die("ERR_CONNECTION_FAILED"); // Print a message and exit from the PHP script
                
            $create_query = "create table Customer (
                user_id int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                connection_type VARCHAR(255),
                total_discount FLOAT, /* 12% discount will be stored as 0.12 */
                balance FLOAT, /* Let us always store balance as float, i.e. 157.00 (RS) */
                black_list_status BIT /* bit for bool. Can have 0 or 1 in it ONLY*/
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
