<?php
session_start();
include('includes/head.php');
include('db_connect.php');
?>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/layout.css">
   <script>
     var check = function() {

    var password = document.getElementById('password').value;

    if (document.getElementById('password').value ==
        document.getElementById('confirmpass').value) {
        document.getElementById('message').style.color = 'green';
        document.getElementById('message').innerHTML = 'matching';
    } else {
        document.getElementById('message').style.color = 'red';
        document.getElementById('message').innerHTML = 'not matching';
    }

    if (password.length < 8) {
        document.getElementById('message').style.color = 'red';
        document.getElementById('message').innerHTML = 'Password length must be at least 8 characters!';
    }
}
   </script>
</head>
<body>
    <section>
        <center>
    <form action="registerProcess.php" method="post" enctype="multipart/form-data">
    <div class="container">
        <h1 style="font-size: 40px;">Register</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>
        <label for=""><b>Full Name</b></label>
         <input type="text" name="name" id="" placeholder="Song Jong Ki" required/>
        <label for=""><b>Email Address</b></label>
        <input type="email" name="email" placeholder="jongki@gmail.com" required/>
        <label for=""><b>Contact Number</b></label>
        <input type="text" name="phoneNo" id="" placeholder="eg:012345890"/>
        <label for=""><b>Username</b></label>
        <input type="text" name="username" id="username" placeholder="JongKi"/>
        <label><b>Password</b>
        <input name="password" id="password" type="password" onkeyup='check();' />
        </label>
        <br>
        <label><b>Confrim Password</b>
        <input type="password" name="confirmpass" id="confirmpass"  onkeyup='check();' /> 
        <span id='message'></span>
        </label>
        <input type="hidden" name="userType" id="userType" value="donor"/>
        <button type="submit" name="registerbtn" class="registerbtn">Register</button>
    </div>
    
    <div class="container signin">
        <p>Already have an account? <a href="login.php">Sign in</a>.</p>
    </div>
    </form>
</center>
</section>
</body>
</html>