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
            $approved_bit = 1;

            if ($obtained_role == "Admin" || $obtained_role == "Staff")
                $approved_bit = 0;
            $write_query_result = 0;

            if(!preg_match ('/[^A-Za-z0-9]+/', $obtained_password))
                die("<h2 style = 'color: red; text-align: center;'> ERR_PASSWORD_NOT_ALPHANUMERIC_WITH_SPECIAL_CHARACTERS </h2>");
            else if (strlen($obtained_password) < 8)
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
                if (!$write_query_result && !$rows_returned)
                    echo mysqli_error($connect);
                else 
                    header("Location: ../index.html");
            }
        }
        else
            die("<h2 style = 'color: red; text-align: center;'> ERR_FORM_NOT_COMPLETELY_FILLED </h2>");
    }
?>
