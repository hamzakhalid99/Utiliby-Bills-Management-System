<?php 
  include "generic_layout.php";
?>
<h2 style="text-align: center; "> View & Update Bill </h2>
    <div style="text-align: center; width: 100%">
    </div>
</body>
<table border = "2" style = "text-align: center; ">
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
