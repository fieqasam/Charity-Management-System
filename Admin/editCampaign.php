<?php
  session_start();
  include('../db_connect.php');
  include('head.php');
//Get the current session
if (isset($_SESSION['auth'])) {
    $userID = $_SESSION['auth_user']['userID'];
    $fullName = $_SESSION['auth_user']['fullName'];
    $email = $_SESSION['auth_user']['email'];
    $contactNo = $_SESSION['auth_user']['contactNo'];
    $userType = $_SESSION['auth_user']['userType'];
  }
  else
  {
     echo "Not Logged In";
  }
  ?>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="style2.css">
    <title>Charity Management System</title>
    </head>
    <body>
    <section class="banner-section">
        <img src="images/banner2.jpg" alt="" >
        <h1 class="centered">Fund Raiser</h1>
    </section>
    <section class="newFund-section">
        <h2 style="padding-left:20px;">Update Fund Raiser</h2>
        <div class="container">
          <form action="code.php" name="myForm" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
          <?php 
          if (isset($_GET['campaignID'])) {

              $campaignID = $_GET['campaignID'];

              $query="SELECT * FROM fundrisercampaignn WHERE campaignID='$campaignID'";
              $query_run = mysqli_query($con, $query);

              if (mysqli_num_rows($query_run)>0) {
                foreach ($query_run as $row) {
                    ?>
                     <div class="row">
                    <div class="col-25">
                        <label for="">Title</label>
                    </div>
                    <div class="col-75">
                        <input type="hidden" name="campaignID" value="<?php echo $campaignID; ?>">
                        <input type="text" name="title" id="title" value="<?php echo $row['title']; ?>" placeholder="title">
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-25">
                        <label for="">Banner Image</label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="oldBannerImage" id="oldBannerImage" value="<?php echo $row['bannerImage']; ?>" ><br><br>
                        <input type="file" name="bannerImage" id="bannerImage" onchange="return fileValidation()">
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-25">
                        <label for="">Description</label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="description" id="description" value="<?php echo $row['description']; ?>" style="height:100px">
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-25">
                        <label for="">Start Date</label>
                    </div>
                    <div class="col-75">
                        <input type="date" name="startDate" value="<?php echo $row['startDate']; ?>" id="startDate">
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-25">
                        <label for="">End Date</label>
                    </div>
                    <div class="col-75">
                        <input type="date" name="endDate" value="<?php echo $row['endDate']; ?>" id="endDate">
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-25">
                        <label for="">Amount (RM)</label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="amountFund" id="amountFund"  value="<?php echo $row['amount']; ?>">
                        <input type="hidden" name="userID" value="<?php echo $userID; ?>">
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-25">
                        <label for="">Status</label>
                    </div>
                    <div class="col-75">
                        <select name="status" id="status" value="<?php echo $row['status']; ?>">
                        <option value="active"> Active</option>
                        <option value="not active"> Not Active</option>
                        </select>
                    </div>
                    </div>
                    <br>
                    <div class="row">
                    <input type="submit" name="updateCampaign" value="Update">
                    <input type="reset" name="resetBtn" value="Reset">
                    </div>
                    <?php
                }
              }else {
                echo "<h4>No record found!</h4>";
              }
          }
          ?>
           
        </form>
        </div>
    </section>
    </body>
</html>