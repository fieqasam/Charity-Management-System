<?php 
session_start();
include('head.php');
include('../db_connect.php');

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
        <h1 class="centered">Staff</h1>
    </section>
    <section class="newFund-section">
        <h2 style="padding-left:20px;">View Staff Info</h2>
        <div class="container">
          <form action="code.php" name="myForm" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
          <?php 
          if (isset($_GET['userID'])) {

              $userID = $_GET['userID'];

              $query="SELECT * FROM member WHERE userID='$userID'";
              $query_run = mysqli_query($con, $query);

              if (mysqli_num_rows($query_run)>0) {
                foreach ($query_run as $row) {
                    ?>
                     <div class="row">
                    <div class="col-25">
                        <label for="">Staff Name</label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="staffName" id="staffName" value="<?php echo $row['fullName']; ?>" readonly>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-25">
                        <label for="">Staff Email</label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="staffEmail" id="staffEmail" value="<?php echo $row['email'] ?>" readonly>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-25">
                        <label for="">Staff Contact No</label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="staffContact" id="staffContact" value="<?php echo $row['contactNo']; ?>" readonly>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-25">
                        <label for="">username</label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="username" id="username" value="<?php echo $row['username']; ?>" readonly>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-25">
                        <label for="">Staff Type</label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="staffType"  id="staffType" value="<?php echo $row['userType']; ?>" readonly>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-25">
                        <label for="">Status</label>
                    </div>
                    <div class="col-75">
                    <input type="text" name="staffStatus" value="Active" readonly>
                    </div>
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