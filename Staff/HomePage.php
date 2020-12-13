<?php 
  include "Home_Page.php";
?>
<table class="table" style="font-size: 18px;">
    <tr>
        <th class="font-weight-light">Name</th>
        <th class="font-weight-light"><?php echo $_SESSION['name'] ?></th>
    </tr>
    <tr>
        <th class="font-weight-light">EMAIL</th>
        <th class="font-weight-light"><?php echo $_SESSION['email_id'] ?></th>
    </tr>
    <tr>
        <th class="font-weight-light">CNIC</th>
        <th class="font-weight-light"><?php echo $_SESSION['cnic'] ?></th>
    </tr>
    <tr>
        <th class="font-weight-light">ADDRESS</th>
        <th class="font-weight-light"><?php echo $_SESSION['address'] ?></th>
    </tr>
    <tr>
        <th class="font-weight-light">CONTACT NO</th>
        <th class="font-weight-light"><?php echo $_SESSION['contact_number'] ?></th>
    </tr>
</table>
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
