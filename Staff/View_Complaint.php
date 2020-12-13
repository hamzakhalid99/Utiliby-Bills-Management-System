 <?php 
  include "Home_Page.php";
?>

        <?php
          $utility_id = $_GET["utility_id"];
          $complaint_id = $_GET["complaint_id"];
          $user_id = $_SESSION['user_id'];
          $name = $_SESSION['name'];
          $query="SELECT Utilities.utility_name
          FROM Utilities
          Where utility_id='".$utility_id."';";
          $tuples = mysqli_query($connect,$query); 
          while($one_row = mysqli_fetch_assoc($tuples))
          {
            $utility_name = $one_row["utility_name"];
            } 
          $query="SELECT *
          FROM complaint
          Where complaint_id='".$complaint_id."';";
          $tuples = mysqli_query($connect,$query); 
          while($one_row = mysqli_fetch_assoc($tuples))
          {
            $status = $one_row["complaint_status"];
            $date = $one_row['registeration_date'];
            $pay_date = $one_row['resolution_date'];
            $escalation = $one_row['escalation_status'];
            } 
        ?> 
        <div class="container-fluid">
          <div class="row">
            <h2 style="font-size: 50px"><?php echo $utility_name ?></h2>
          </div>
          <hr style="border-width: 2px;">
        </div>
        <div class="row bg-dark " style="border-radius: 10px;box-shadow: 0 5px 10px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.0);">
          <div class='col'>
            <h4 class="mb-2 font-weight-light text-light" style="text-align: center;">Complaint No:</h4>
            <h4 class="mb-2 font-weight-light text-light" style="text-align: center;"><?php echo $complaint_id; ?></h4>
          </div>
          <div class='col'>
            <h4 class="mb-2 font-weight-light text-light" style="text-align: center;">Status:</h4>
            <h4 class="mb-2 font-weight-light text-light" style="text-align: center;"> <?php echo $status; ?></h4>
          </div>
          <div class='col'>
            <h4 class="mb-2 font-weight-light text-light" style="text-align: center;">Date Initiated: </h4>
            <h4 class="mb-2 font-weight-light text-light" style="text-align: center;"><?php echo $date; ?></h4>
          </div>
          <div class='col'>
            <h4 class="mb-2 font-weight-light text-light" style="text-align: center;">Date Resolved: </h4>
            <h4 class="mb-2 font-weight-light text-light" style="text-align: center;"><?php echo $pay_date; ?></h4>
          </div>
          <div class='col'>
            <h4 class="mb-2 font-weight-light text-light" style="text-align: center;">Escalation Status: </h4>
            <h4 class="mb-2 font-weight-light text-light" style="text-align: center;"><?php echo $escalation; ?></h4>
          </div>
      </div>
        <div style="height:450px;overflow-y: scroll;">
        <?php 
          $query = "SELECT * FROM Messages WHERE complaint_id='".$complaint_id."'";
          $tuples = mysqli_query($connect,$query); 
          while($one_row = mysqli_fetch_assoc($tuples))
          {
            $msg = $one_row["message_content"];
            $sender = $one_row["sender_name"];
            $date = $one_row["date_sent"];
            if ($sender == $name)
            {
               echo '<div class=" container bg-dark text-light custom-header-me">'."$sender\t\tat\t\t$date".'</div>
                <div class=" container bg-secondary text-light custom-msg-me">'.$msg.'</div>';
            }
            else
            {
               echo '<div class=" container bg-dark text-light custom-header-him">'."$sender\t\t$date".'</div>
                <div class=" container bg-secondary text-light custom-msg-him">'.$msg.'</div>';
            }
          }
          ?>
        </div>
        <?php 
              if ($status == 0)
              {

              }
              else
              {
                echo '<br>
                    <form method = "post" action="New_Complaint.php">
                        <input type="hidden" name="sender" value="'.$name.'">
                        <input type="hidden" name="complaint_id" value="'.$complaint_id.'">
                        <input type="hidden" name="util_ID" value="'.$utility_id.'">
                        <div class="form-row">
                            <div class="form-group col">
                                <input class="form-control form-control-lg" type = "text" placeholder = "Enter Message" name = "msg"> 
                            </div>
                        <button class = "btn btn-primary form-group col" style="font-size: 20px; text-align: center;max-width:100px;"type = "submit" name = "send_form"> send </button>
                    </form>
                    <form method="post" action="Close_Complaint.php">
                        <input type="hidden" name="complaint_id" value="'.$complaint_id.'">
                        <button class = "btn btn-primary form-group col" style="margin-left: 5px;font-size: 20px; text-align: center;max-width:100px;min-height: 50px;"type = "submit" name = "send_form">Close</button></form>
                    </div>
                    </form>';
              }
      ?>
      </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>