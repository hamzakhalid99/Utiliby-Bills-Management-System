<?php 
    include "../DB_Connection/database_connection.php";

    if (isset($_POST["submitted_form"]))
    {
        if 
        (
            (!empty($_POST["user_email"])) && (!empty($_POST["user_fullname"])) && 
            (!empty($_POST["user_cnic"])) && (!empty($_POST["user_home"])) && 
            (!empty($_POST["user_username"])) && (!empty($_POST["user_contact"])) && 
            (!empty($_POST["user_password"])) && (!empty($_POST["user_role"]))
        )
        {
            $obtained_fullname = $_POST["user_fullname"];
            $obtained_email = $_POST["user_email"];
            $obtained_cnic = $_POST["user_cnic"];
            $obtained_address = $_POST["user_home"];
            $obtained_username = $_POST["user_username"];
            $obtained_contact = $_POST["user_contact"]; 
            $obtained_password = $_POST["user_password"];
            $obtained_role = $_POST["user_role"];
            $customer_connection_type = "";
            $approved_bit = 0;
            
            if ($obtained_role == "Residential" || $obtained_role == "Commercial" || $obtained_role == "Industrial")
            {
                $customer_connection_type = $obtained_role;
                $obtained_role = "Customer";
                $approved_bit = 1;
            }
            $write_query_result = 0;

            if(!preg_match ('/[^A-Za-z0-9]+/', $obtained_password)) // Alpha Numeric Check with special characters
                die("<h2 style = 'color: red; text-align: center;'> ERR_PASSWORD_NOT_ALPHANUMERIC_WITH_SPECIAL_CHARACTERS </h2>");
            else if (strlen($obtained_password) < 8) // Length check
                die("<h2 style = 'color: red; text-align: center;'> ERR_PASSWORD_TOO_SHORT </h2>");
            else
            {
                $duplicate_username_query = "SELECT * FROM User WHERE username = '$obtained_username'";
                $username_query_result = mysqli_query($connect, $duplicate_username_query);
                $rows_returned = mysqli_num_rows($username_query_result);
                
                if($rows_returned == 0)
                {
                    $hash_format = "$2y$10$"; // Specific format for hashing
                    $salt = "m1ni7eisu0avrcpzjlqOw1"; // Salt needs to be 22 characters long (VERY, VERY PRECISELY)
                    $concatenate = $hash_format . $salt;
                    $obtained_hashed_password = crypt($obtained_password, $concatenate); // Encryption process based on the user input and hashing format
                    
                    $write_query = "INSERT INTO User(name, cnic, contact_number, email_id, address, username, password, role, approved_bit)";
                    $write_query .= "VALUES('$obtained_fullname', '$obtained_cnic', '$obtained_contact', '$obtained_email', '$obtained_address', '$obtained_username', '$obtained_hashed_password', '$obtained_role', $approved_bit)";
                    $write_query_result = mysqli_query($connect, $write_query);
                }
                else
                {
                    die("<h2 style = 'color: red'; text-align: center;> ERR_USERNAME_UNAVAILABLE </h2>");
                }
                if (!$write_query_result && !$rows_returned) // Check if the first query has been executed properly or not
                {
                    echo mysqli_error($connect);
                }
                else // If first query executed properly, go ahead and check if we need to execute one more query or not (execute only if the customer signed up)
                {
                    if ($customer_connection_type == "Residential" || $customer_connection_type == "Commercial" || $customer_connection_type == "Industrial") // User was the customer. We need to fill the Customer table too
                    {
                        $user_id_query = "SELECT * FROM User ORDER BY user_id DESC LIMIT 1"; // Select the very latest tuple added inside the User table (which definitely contains CUSTOMER (not a staff member, not admin))
                        $user_id_query_result = mysqli_query($connect, $user_id_query);

                        while ($last_tuple = mysqli_fetch_assoc($user_id_query_result))
                        {
                            $obtained_user_id = $last_tuple["user_id"];
                        }
                        $write_query = "INSERT INTO Customer(user_id, connection_type, total_discount, balance, black_list_status)";
                        $write_query .= "VALUES('$obtained_user_id', '$customer_connection_type', 0.0, 0.0, 0)";
                        $write_query_result = mysqli_query($connect, $write_query);

                        if (!$write_query_result)
                        {
                            echo mysqli_error($connect);
                            die("<h2 style = 'color: red'; text-align: center;> ERR_CUSTOMER_TABLE_WRITING_FAILED </h2>");
                        }
                        else 
                        {
                            header("Location: ../Index.html");
                        }
                    }
                    else 
                    {
                        header("Location: ../Index.html");
                    }
                }
            }
        }
        else
            die("<h2 style = 'color: red; text-align: center;'> ERR_FORM_NOT_COMPLETELY_FILLED </h2>");
    }
?>
