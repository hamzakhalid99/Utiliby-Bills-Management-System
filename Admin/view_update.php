<?php 
  include "generic_layout.php";
?>
<h2 style="text-align: center; "> View & Update Utility </h2>
    <div style="text-align: center; width: 100%">
    </div>
</body>
<table border = "2" style = "text-align: center; ">
    <tr>
        <th>Utility id</th>
        <th>Connection type</th>
        <th>Utility name</th>
        <th>Fixed montly price</th>
        <th>Unit price</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>

    <?php 
include "../DB_Connection/database_connection.php";
$sql = "SELECT * FROM Utilities";
$result =mysqli_query($connect,$sql);
while($data = mysqli_fetch_array($result))
{
?>
    <tr>
        <td><?php echo $data['utility_id']; ?></td>
        <td><?php echo $data['connection_type']; ?></td>
        <td><?php echo $data['utility_name']; ?></td>
        <td><?php echo $data['fixed_monthly_price']; ?></td>
        <td><?php echo $data['unit_price']; ?></td>
        <td><a href="update.php?id=<?php echo $data['utility_id']; ?>">Update</a></td>
        <td><a href="delete.php?id=<?php echo $data['utility_id']; ?>">Delete</a></td>
    </tr>
    <?php
}
?>
</table>
<!-- very critical lines writeen down below. Do not interfere with the divs -->
</div>
</div>
</div>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</body>

</html>