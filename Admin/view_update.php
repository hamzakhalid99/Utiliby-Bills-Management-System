<?php 
  include "generic_layout.php";
?>
<div class="container-fluid">
    <div class="row">
        <h2 style="text-align: center; "> View & Update Utility</h2>
    </div>
<hr style="border-width: 2px;">
</div>
</body>
 <table class="table" style = "text-align: center; ">
<thead class="thead-dark">
    <tr>
        <th>Utility id</th>
        <th>Connection type</th>
        <th>Utility name</th>
        <th>Fixed montly price</th>
        <th>Unit price</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>
</thead>
</tbody>
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
</tbody>
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