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
                
            $create_query = ""; ////////////////////////////////// ADIL ADD YOUR QUERY HERE IN THE STRING... AND RUN THE FILE IN THE BROWSER ONLY ONCE
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
