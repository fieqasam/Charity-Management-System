<?php 
session_start();
include('head.php');
//save the current session
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

    let type = document.forms["myForm"]["type"].value;
    let descriptionMember = document.forms["myForm"]["descriptionMember"].value;

    if (type == "") {
      alert("Member type must be filled out");
      return false;
    }
    else if (descriptionMember == "") {
      alert("Description must be filled out");
      return false;
    }

    }
    </script>
</head>
<body>
    <section class="banner-section">
        <img src="images/banner2.jpg" alt="" >
        <h1 class="centered">Member</h1>
    </section>
    <section class="newFund-section">
        <h2 style="padding-left:20px;">Member Type</h2>
        <div class="container">
          <form action="code.php" name="myForm" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <div class="row">
              <div class="col-25">
                <label for="">Member Type</label>
              </div>
              <div class="col-75">
                <input type="text" name="memberType" id="memberType" placeholder="Member type" required>
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for="">Description</label>
              </div>
              <div class="col-75">
                <input type="text" name="descriptionMember" id="descriptionMember" required>
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for="">Status</label>
              </div>
              <div class="col-75">
                <select name="memberStatus" id="memberStatus">
                  <option value="active"> Active</option>
                  <option value="not active"> Not Active</option>
                </select>
              </div>
            </div>
            <br>
            <div class="row">
              <input type="submit" name="addMemberType" value="Submit">
              <input type="reset" name="resetMemberType" value="Reset">
            </div>
        </form>
        </div>
    </section>
</body>
</html>