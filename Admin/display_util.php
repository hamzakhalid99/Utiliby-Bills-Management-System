<?php 
    include "../DB_Connection/database_connection.php";
    $query = "SELECT * FROM Utilities WHERE utility_id = 'ER'";
    $result = mysqli_query($connect, $query);

    if (!$result)
        echo "yaaar. shit yar";
    
    while($one_row = mysqli_fetch_assoc($result))
    {
        echo $one_row["connection_type"];
        $img__ = $one_row["image"];
        echo "<img width = '150' src = 'pics/$img__'>";
    }
?>
