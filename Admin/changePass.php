<?php 
session_start();
include('../db_connect.php');
include('head.php');

$username = $_SESSION['auth_user']['username'];
$password = $_SESSION['auth_user']['password'];
?>
<html>
<head>
<title>Charity Management System</title>
<link rel="stylesheet" type="text/css" href="style2.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<style>
  .error-msg {
    width: 100%;
    font-family: 'nobelregular';
    color: #ff0002;
    display: none;
}
</style>
<script>
  $(document).ready(function() {
			$("#old-password").change(function(){
       var value = $("#old-password").val();
     if(value===''){
     alert("please enter Old Password");
     }
      
      });
          $("#submitBtn").click(function(){
              validate();
          });
        });

        function validate() {
         var value = $("#old-password").val();
           if(value===''){
           
           alert("please enter Old Password");
           }
          var password1 = $("#password1").val();
          var password2 = $("#password2").val();
            if(password1 != password2) {
               $(".error-msg").html("Password and confirmation password do not match.").show();                    
            }
            else {
                $(".error-msg").html("").hide();  
                ValidatePassword();
            }
        }

        function ValidatePassword() {
          var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,}$/;
          var txt = document.getElementById("password1");
          if (!regex.test(txt.value)) {
              $(".error-msg").html("The password does not meet the password policy requirements.").show();
          } else {
              $(".error-msg").html("").hide();
              window.location.href='change-password-msg.html';
          }
        }
</script>
</head>
<body>
    <section class="banner-section">
        <img src="images/banner2.jpg" alt="" >
        <h1 class="centered">Change Password</h1>
    </section>
    <section class="newFund-section">
        <h2 style="padding-left:20px;">Staff - Change Password</h2>
        <div class="container">
        <div class="error-msg"></div>
          <form action="code.php" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-25">
                <label for="">Existing Password</label>
              </div>
              <div class="col-75">
                <input type="password" name="oldPass" id="old-password" placeholder="">
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for=""> New Password</label>
              </div>
              <div class="col-75">
                <input type="password" name="newPass" id="password1" placeholder="" onkeyup='check();' required>
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for="">Confirm Password</label>
              </div>
              <div class="col-75">
                <input type="password" name="confirmPass" id="password2" placeholder="" onkeyup='check();' required><br>
                <span id='message'></span>
              </div>
            </div>
            <br>
            <div class="row">
              <input type="submit" name="ChangePass" value="Submit">
              <input type="reset" value="RESET PROFILE">
            </div>
        </form>
        </div>
    </section>
</body>
</html>