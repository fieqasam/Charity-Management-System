<?php 
session_start();
include('head.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity Management System</title>
    <link rel="stylesheet" type="text/css" href="style2.css">
    <script>
      function validateForm() {
          
          let staffName = document.forms["myForm"]["staffName"].value;
          let loginId = document.forms["myForm"]["loginId"].value;
          let staffPass = document.forms["myForm"]["staffPass"].value;
          let confirmPass = document.forms["myForm"]["confirmPass"].value;

          if (staffName == "") {
            alert("Staff name must be filled out");
            return false;
          }
          else if (loginId == "") {
            alert("Login id must be filled out");
            return false;
          }
          else if (staffPass == "") {
            alert("Staff passowrd must be filled out");
            return false;
          }
          else if (confirmPass == "") {
            alert("Confirm passowrd must be filled out");
            return false;
          }
          else if (staffPass != confirmPass) {
            alert("Password doesnot match !");
            return false;
          }
        }
  }
    </script>
</head>
<body>
    <section class="banner-section">
        <img src="images/banner2.jpg" alt="" >
        <h1 class="centered">Staff</h1>
    </section>
    <section class="newFund-section">
        <h2 style="padding-left:20px;">Staff - Add New Staff</h2>
        <div class="container">
          <form action="code.php" name="myForm" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
          <div class="row">
              <div class="col-25">
                <label for="">Staff Type</label>
              </div>
              <div class="col-75">
                <select name="staffType" id="staffType">
                  <option value="admin"> Admin</option>
                  <option value="employee"> Employee</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for="">Staff Name</label>
              </div>
              <div class="col-75">
                <input type="text" name="staffName" id="staffName" placeholder="" required>
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for=""> Staff Username</label>
              </div>
              <div class="col-75">
                <input type="text" name="username" id="username" placeholder="" required>
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for=""> Staff Email</label>
              </div>
              <div class="col-75">
                <input type="text" name="staffEmail" id="staffEmail" placeholder="" required>
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for=""> Staff Contact No</label>
              </div>
              <div class="col-75">
                <input type="text" name="staffContact" id="staffContact" placeholder="" required>
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for=""> Staff Password</label>
              </div>
              <div class="col-75">
                <input type="password" name="staffPass" id="staffPass" placeholder="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number 
                and one uppercase and lowercase letter, and at least 8 or more characters" required>
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for="">Confirm Password</label>
              </div>
              <div class="col-75">
                <input type="password" name="confirmPass" id="confirmPass" placeholder="" required>
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for="">Status</label>
              </div>
              <div class="col-75">
                <select name="staffStatus" id="staffStatus">
                  <option selected>select status</option>
                  <option value="active"> Active</option>
                  <option value="not active"> Not Active</option>
                </select>
              </div>
            </div>
            <br>
            <div class="row">
              <input type="submit" name="addStaff" value="Submit">
              <input type="reset" name="resetStaff" value="Reset">
            </div>
        </form>
        </div>
    </section>
</body>
</html>