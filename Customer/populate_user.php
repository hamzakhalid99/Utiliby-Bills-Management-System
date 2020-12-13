<?php
	include "../DB_Connection/database_connection.php";
	$obtained_password = "123abc!!";
	$hash_format = "$2y$10$"; // Specific format for hashing
    $salt = "m1ni7eisu0avrcpzjlqOw1"; // Salt needs to be 22 characters long (VERY, VERY PRECISELY)
    $concatenate = $hash_format . $salt;

    for ($i = 0; $i<20; $i++)
    {
	    $obtained_hashed_password = crypt($obtained_password, $concatenate); // Encryption process based on the user input and hashing format
	    $obtained_cnic = rand(1000000000000,9999999999999);
	    $contact_1 = 923000000000;

	    $contact_2 = rand(100000000,999999999);
	    $obtained_contact = $contact_1 + $contact_2;
	    $names = array("Ali", "Ahmad", "Asad", "Adil", "Ahad", "Alina", "Bob", "Cyril", "Chris", "Champ", "Dick", "Dan", "Don", "Da", "Eli", "Frank", "Fatime", "Frog", "Ghajni", "Gerry", "Ghost", "Hamza", "Haris", "Hanna", "Chere","Thresa", "Russell", "Brian", "Debora", "Randall", "Kristine", "Alexandra", "Gertrudis", "Tammara", "Chia","Traci","Rhona","Carlotta","Deandre","Elijah","Berta","Eun","Reed","Lennie","Providencia","Fallon","Hildegarde","Clemente","Maple","Rudolf","Dean","Zenaida","Janiece","Ashly","Ronnie","Thalia","Alycia","January");
	    $obtained_fullname = $names[rand(0,count($names)-1)] . " ". $names[rand(0,count($names)-1)];
	    $obtained_username = substr($obtained_fullname, 0, 3) . strval($i);
	    $obtained_email = $obtained_username . "@gmail.com";
	    $obtained_address =  "House Number" . " " . strval($i) . " ". "Lahore";
	    $approved_bit = 1;
	    $obtained_role = "Customer"; 

	    $write_query = "INSERT INTO User(name, cnic, contact_number, email_id, address, username, password, role, approved_bit)";
	    $write_query .= "VALUES('$obtained_fullname', '$obtained_cnic', '$obtained_contact', '$obtained_email', '$obtained_address', '$obtained_username', '$obtained_hashed_password', '$obtained_role', $approved_bit)";
	    $write_query_result = mysqli_query($connect, $write_query);


	    $user_id_query = "SELECT * FROM User ORDER BY user_id DESC LIMIT 1"; // Select the very latest tuple added inside the User table (which definitely contains CUSTOMER (not a staff member, not admin))
        $user_id_query_result = mysqli_query($connect, $user_id_query);

        while ($last_tuple = mysqli_fetch_assoc($user_id_query_result))
        {
            $obtained_user_id = $last_tuple["user_id"];
        }
        $write_query = "INSERT INTO Customer(user_id, connection_type, total_discount, balance, black_list_status)";
        $write_query .= "VALUES('$obtained_user_id', 'Residential', 0.0, 0.0, 0)";
        $write_query_result = mysqli_query($connect, $write_query);
	}
?>