<?php 
  include "generic_layout.php";
?>

<h2 style = "text-align: center; "> Change Your Password </h2>

<div>
    <form style = "text-align: center; " method = "post">
        <input type = "password" name = "old_pass" placeholder = "Confirm Old Password"> <br> <br>
        <input type = "password" name = "new_pass" placeholder = "Create New Password"> <br> <br>
        <input type = "password" name = "again_new_pass" placeholder = "Confirm New Password"> <br> <br>
        <input type = "submit" class = "btn btn-primary" name = "Process" value = "Change Password" >
    </form>
</div>

<?php 
    if (isset($_POST["Process"]))
    {
        if (!empty($_POST["old_pass"]) && !empty($_POST["new_pass"]) && !empty($_POST["again_new_pass"]))
        {
            $id = $_SESSION["user_id"];
            $old_pass = $_POST["old_pass"];
            $select = "SELECT  password FROM User WHERE user_id = $id";
            $select_result = mysqli_query($connect, $select);

            if ($select_result)
            {
                while ($pass = mysqli_fetch_assoc($select_result))
                {
                    $DB_hashed_pass = $pass["password"];
                }
                $hash_format = "$2y$10$"; // Specific format for hashing
                $salt = "m1ni7eisu0avrcpzjlqOw1"; // Salt needs to be 22 characters long (VERY, VERY PRECISELY)
                $concatenate = $hash_format . $salt;
                $obtained_hashed_password = crypt($old_pass, $concatenate); // Encryption process based on the user input and hashing format
            }

            if ($DB_hashed_pass == $obtained_hashed_password)
            {
                $new_pass = $_POST["new_pass"];
            
                if(!preg_match ('/[^A-Za-z0-9]+/', $new_pass)) // Alpha Numeric Check with special characters
                    echo("<h2 style = 'color: red; text-align: center;'> ERR_PASSWORD_NOT_ALPHANUMERIC_WITH_SPECIAL_CHARACTERS </h2>");
                else if (strlen($new_pass) < 8) // Length check
                    echo("<h2 style = 'color: red; text-align: center;'> ERR_PASSWORD_TOO_SHORT </h2>");
                else // if new password does not have any issues and it is totally acceptable ... go ahead and check if the user added new password properly for the second time
                {
                    $confirmation = $_POST["again_new_pass"];
                    if ($confirmation == $new_pass)
                    {
                        $hash_format = "$2y$10$"; // Specific format for hashing
                        $salt = "m1ni7eisu0avrcpzjlqOw1"; // Salt needs to be 22 characters long (VERY, VERY PRECISELY)
                        $concatenate = $hash_format . $salt;
                        $new_hash = crypt($new_pass, $concatenate); // Encryption process based on the user input and hashing format
                        
                        $update_query = "UPDATE User SET password = '$new_hash' WHERE user_id = $id";
                        $update_result = mysqli_query($connect, $update_query);

                        if ($update_result)
                            echo("<h2 style = 'color: green; text-align: center;'> PASSWORD_CHANGED_SUCCESSFULLY </h2>");
                        else 
                            echo("<h2 style = 'color: red; text-align: center;'> ERR_UPDATION_FAILED </h2>");
                    }
                    else 
                        echo("<h2 style = 'color: red; text-align: center;'> ERR_NEW_PASSWORD_NOT_MATCHED </h2>");
                }
            }
            else
                echo("<h2 style = 'color: red; text-align: center;'> ERR_WRONG_OLD_PASSWORD </h2>");
        }
        else
            echo("<h2 style = 'color: red; text-align: center;'> ERR_FORM_NOT_COMPLETELY_FILLED </h2>");
    }
?>
