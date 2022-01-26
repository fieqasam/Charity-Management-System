<?php 
session_start();
include('head.php');
include('../db_connect.php');

$username = $_SESSION['auth_user']['username'];
$password = $_SESSION['auth_user']['password'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Charity Management System</title>
    <link rel="stylesheet" type="text/css" href="style2.css">
    <script>
       function validateForm() {
          
        let staffType = document.forms["myForm"]["staffType"].value;
        let staffName = document.forms["myForm"]["staffName"].value;
        let loginId = document.forms["myForm"]["loginId"].value;

        if (staffType == "") {
          alert("Staff type must be filled out");
          return false;
        }
        else if (staffName == "") {
          alert("staff Name must be filled out");
          return false;
        }
        else if (loginId == "") {
          alert("Login Id must be filled out");
          return false;
        }

      }
    </script>
</head>
<body>
    <section class="banner-section">
        <img src="images/banner2.jpg" alt="" >
        <h1 class="centered">Profile</h1>
    </section>
    <section class="newFund-section">
        <h2 style="padding-left:20px;">User Profile</h2>
        <div class="container">
          <form action="code.php" name="myForm" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
          <?php 
            $sql = "SELECT * FROM member WHERE username='$username' AND password='$password'";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                
                while ($row = $result->fetch_assoc()) {
                    ?>
                            <div class="row">
                            <div class="col-25">
                                <label for="">User ID</label>
                            </div>
                            <div class="col-75">
                                <input type="text" name="userId" id="userId" value="<?php echo $row['userID']; ?>">
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-25">
                                <label for="">User Type</label>
                            </div>
                            <div class="col-75">
                                <input type="text" name="staffType" id="staffType" placeholder="" value="<?php echo $row['userType']; ?>">
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-25">
                                <label for="">Full Name</label>
                            </div>
                            <div class="col-75">
                                <input type="text" name="fullName" id="fullName" value="<?php echo $row['fullName']; ?>">
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-25">
                                <label for="">User Email</label>
                            </div>
                            <div class="col-75">
                                <input type="text" name="userEmail" id="userEmail" placeholder="" value="<?php echo $row['email']; ?>">
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-25">
                                <label for="">User Contact No</label>
                            </div>
                            <div class="col-75">
                                <input type="text" name="userContact" id="userContact" placeholder="" value="<?php echo $row['contactNo']; ?>">
                            </div>
                            </div>
                    <?php
                }
            }
          ?>

            <br>
            <div class="row">
              <input type="submit" name="updateProfile" value="UPDATE PROFILE">
              <input type="reset" value="RESET PROFILE">
            </div>
        </form>
        </div>
    </section>
</body>
</html>