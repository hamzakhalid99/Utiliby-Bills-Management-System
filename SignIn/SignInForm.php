<?php 
    include "../DB_Connection/database_connection.php";
    if (isset($_POST["submitted_form"]))
    {
        if ((!empty($_POST["username"])) && (!empty($_POST["pass"])))
        {
            $obtained_username = $_POST["username"];
            $obtained_password = $_POST["pass"];
            
            $username_query = "SELECT * FROM User WHERE username = '$obtained_username'";
            $username_query_result = mysqli_query($connect, $username_query);
            $rows_returned = mysqli_num_rows($username_query_result);

            if ($rows_returned > 0)
            {
                $hash_format = "$2y$10$"; // Specific format for hashing
                $salt = "m1ni7eisu0avrcpzjlqOw1"; // Salt needs to be 22 characters long (VERY, VERY PRECISELY)
                $concatenate = $hash_format . $salt;
                $obtained_hashed_password = crypt($obtained_password, $concatenate); // Encryption process based on the user input and hashing format

                while ($each_row = mysqli_fetch_assoc($username_query_result)) // while mysqli_fetch_assoc is == $data_returned, assign it to $each_row
                {
                    $DB_hashed_password = $each_row["password"];
                    $DB_role = $each_row["role"];
                    $DB_name = $each_row["name"];
                    $DB_cnic = $each_row["cnic"];
                    $DB_contact = $each_row["contact_number"];
                    $DB_email = $each_row["email_id"];
                    $DB_address = $each_row["address"];
                    $DB_username = $each_row["username"];
                    $DB_approval = $each_row["approved_bit"];
                    $DB_id = $each_row["user_id"];
                }

                if ($DB_hashed_password == $obtained_hashed_password)
                {
                    session_start();
                    $_SESSION["user_id"] = $DB_id;
                    $_SESSION["name"] = $DB_name;
                    $_SESSION["cnic"] = $DB_cnic;
                    $_SESSION["contact_number"] = $DB_contact;
                    $_SESSION["email_id"] = $DB_email;
                    $_SESSION["address"] = $DB_address;
                    $_SESSION["username"] = $DB_username;
                    $_SESSION['logged_in'] = 1;
                    
                    if ($DB_role == 'Admin' && $DB_approval == 1)
                        header("Location: ../Admin/Home_Page.php");
                    elseif ($DB_role == 'Customer' && $DB_approval == 1) 
                        header("Location: ../Customer/Home_Page.php");
                    elseif ($DB_role == 'Staff' && $DB_approval == 1)
                        header("Location: ../Staff/Home_Page.php");
                    else // No other role is possible. So, if you come here, you are definitely unapproved
                    {
                        echo("<h2 style = 'color: red; text-align: center;'> ERR_");
                        echo $DB_role;
                        echo ("_UNAPPROVED </h2>");
                    }
                }
                else 
                    echo("<h2 style = 'color: red; text-align: center;'> ERR_WRONG_PASSWORD </h2>");
            }
            else 
                echo("<h2 style = 'color: red; text-align: center;'> ERR_WRONG_USERNAME </h2>");
        }
    }
?>
