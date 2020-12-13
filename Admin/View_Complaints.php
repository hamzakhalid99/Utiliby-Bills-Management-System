<?php 
  include "generic_layout.php";
?>

        <?php
          $utility_id = $_GET["utility_id"];
          $user_id = $_SESSION['user_id'];
          $query="SELECT Utilities.utility_name
          FROM Utilities
          Where utility_id='".$utility_id."';";
          $tuples = mysqli_query($connect,$query); 
          while($one_row = mysqli_fetch_assoc($tuples))
          {
            $utility_name = $one_row["utility_name"];
            } 
        ?> 
        <h2 class="mb-4 ">All Complaints</h2>
        <hr style="border-width: 2px;">
        <div class="container-fluid">
          <table class="table" style="font-size: 20px">
            <thead class="thead-dark">
            <tr>
              <th class='font-weight-light'>Complaint ID</th>
              <th class='font-weight-light'>Name</th>
              <th class='font-weight-light'>Utility</th>
              <th class='font-weight-light'>Status</th>
              <th class='font-weight-light'>Type</th>
              <th class='font-weight-light'>Date</th>
              <th class='font-weight-light'>Resolution Date</th>
              <th class='font-weight-light'>Escalation</th>
              <th class='font-weight-light'>View</th>
            </tr>
            </thead>
            <tbody>
              <?php
                $user_id = $_SESSION['user_id'];
                $query = "SELECT * FROM complaint INNER JOIN User USING(user_id) WHERE escalation_status=b'1'";
                $tuples = mysqli_query($connect,$query); 
                while($one_row = mysqli_fetch_assoc($tuples))
                {
                  $complaint_id = $one_row["complaint_id"];
                  $utility_id = $one_row["utility_id"];
                  $due = $one_row["complaint_status"];
                  $status = $one_row["complaint_desc"];
                  $gen_date = $one_row["registeration_date"];
                  $recieved = $one_row["resolution_date"];
                  $pay_date = $one_row["escalation_status"];
                  $name = $one_row['name'];
                  echo 
                  "<tr>
                  <td class='font-weight-light'>".$complaint_id."</td>
                  <td class='font-weight-light'>".$name."</td>
                  <td class='font-weight-light'>".$utility_id."</td>
                  <td class='font-weight-light'>".$due."</td>
                  <td class='font-weight-light'>".$status."</td>
                  <td class='font-weight-light'>".$gen_date."</td>
                  <td class='font-weight-light'>".$recieved."</td>
                  <td class='font-weight-light'>".$pay_date."</td>
                  <td class='font-weight-light'><a href='View_Complaint.php?complaint_id=".$complaint_id."&utility_id=".$utility_id."'>view</a></td>
                  </tr>";


                } 
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>