<?php 
  include "Home_Page.php";
?>
<div class="container-fluid">
    <div class="row">
        <h2 style="text-align: center; "> View & Update Bill </h2>
    </div>
<hr style="border-width: 2px;">
</div>
</body>
 <table class="table" style = "text-align: center; ">
<thead class="thead-dark">
    <tr>
        <th> Invoice id </th>
        <th> User id </th>
        <th> Utility id </th>
        <th> Bill amount </th>
        <th> Amount received </th>
        <th> Bill due </th>
        <th> Bill status </th>
        <th> Bill generation date </th>
        <th> Date of payment </th>
        <th> Update </th>
    </tr>
</thead>
<?php 
include "../DB_Connection/database_connection.php";
$sql = "SELECT * FROM invoice";
$result =mysqli_query($connect,$sql);
while($data = mysqli_fetch_array($result))
{
?>
    <tr>
        <td><?php echo $data['invoice_id']; ?></td>
        <td><?php echo $data['user_id']; ?></td>
        <td><?php echo $data['utility_id']; ?></td>
        <td><?php echo $data['bill_amount']; ?></td>
        <td><?php echo $data['amount_received']; ?></td>
        <td><?php echo $data['bill_due']; ?></td>
        <td><?php echo $data['bill_status']; ?></td>
        <td><?php echo $data['bill_generation_date']; ?></td>
        <td><?php echo $data['date_of_payment']; ?></td>
        <td><a href="update_bill.php?id=<?php echo $data['invoice_id']; ?>">Update</a></td>
    </tr>
    <?php
}
?>
</table>
<script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
