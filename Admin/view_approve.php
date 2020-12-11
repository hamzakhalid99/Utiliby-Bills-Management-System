<?php
    include "generic_layout.php";
    include "../DB_Connection/database_connection.php";
?>
    <div class="container-fluid">
    <div class="row">
        <h2 style="text-align: center; "> View & Accept Requests</h2>
    </div>
    <hr style="border-width: 2px;">
    <table class="table" style = "text-align: center; ">
    <thead class="thead-dark">
    <tr>
        <th> Name </th>
        <th> Username </th>
        <th> CNIC </th>
        <th> Cell Number </th>
        <th> Role </th>
        <th> Approve </th>
    </tr>
</thead>
<?php 

    $sql = "SELECT * FROM User WHERE approved_bit = 0";
    $result = mysqli_query($connect,$sql);
    while($data = mysqli_fetch_array($result))
    {
        $user_id = $data["user_id"];
    ?>
        <tr>
            <td><?php echo $data['name']; ?></td>
            <td><?php echo $data['username']; ?></td>
            <td><?php echo $data['cnic']; ?></td>
            <td><?php echo $data['contact_number']; ?></td>
            <td><?php echo $data['role']; ?></td>
            <td> <a href = "approve.php?approve_id=<?php echo $data["user_id"] ?>"> Approve </a> </td>
        </tr>
    <?php
}
?>
</table>
    <!-- Don't disturb these divisions. They start in some other file called generic_layout.php -->
            </div>
        </div>
    </div>
</div>

<!-- <script>
    src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    $('.one').on('click', function(event) { 
        let id = event.target.id;
        console.log(id);
        <?php 
            // $update_query = "UPDATE User SET approved_bit = 1 WHERE user_id = $user_id";
            // $query = mysqli_query($connect, $update_query);
            // if ($query )
            //     header("Location: view_approve.php");
            // else 
            //     echo "shit";
        ?>
    });
</script> -->

<script src="js/jquery.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</body>

</html>
