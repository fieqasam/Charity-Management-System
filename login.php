<?php 
session_start();
include('includes/head.php');
?>

<html lang="en">
<head>
   <link rel="stylesheet" type="text/css" href="css/layout.css">
   <script>
       var check = function() {

        var password = document.getElementById('password').value;
        var username = document.getElementById('username').value;

        if (username =="" || password == "") {

            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'Please fill all the required fields!';
        }else{
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = 'All fields is complete';
        }

       }

   </script>
</head>
<body>
    <section>
        <center>
        <form action="signIn_process.php" method="post" enctype="multipart/form-data">
            <div class="container">
                <h1 style="font-size: 40px;">Login</h1>
                <p>Please fill in this form to login.</p>
                <hr>
                <label for=""><b>Username</b></label>
                <input type="text" name="username" id="username" placeholder="Jong ki" onkeyup='check();' required/>
                <label for=""><b>Password</b></label>
                <input type="password" name="password" id="password" placeholder="password" onkeyup='check();' required/>
                <label for="">
                <span id='message'></span>
                </label>
                <button type="submit" name="loginBtn" class="registerbtn">Login</button>
            </div>
            <div class="container signin">
                <p>Doesn't  have an account yet? <a href="register.php">Register Now</a>.</p>
            </div>
            </form>
        </center>
    </section>
</body>
</html>