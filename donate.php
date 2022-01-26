<?php 
session_start();
include('includes/head.php');
include('db_connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity Management System</title>
    <link rel="stylesheet" href="css/layout.css">
</head>
<body>
    <section>
    <center>
        <form action="" method="post">
            <div class="container">
                <h1 style="font-size: 40px;">Donate Here!</h1>
                <p>Please fill in this form to make your donation.</p>
                <hr>
                <label for=""><b>YOUR NAME</b></label>
                 <input type="text" name="name" id="" placeholder="your name here" required/>
                <label for=""><b>EMAIL ADDRESS</b></label>
                <input type="email" name="email" placeholder="john@gmail.com" required/>
                <label for=""><b>AMOUNT YOU WANT TO DONATE</b></label>
                <input type="donate" name="donate" placeholder="1, 3, 5, 10..." required/>
                
                <p>By making donation, you agree to our <a href="#">Terms & Privacy</a>.</p>
        
                <button type="submit" class="registerbtn">Make Your Donation</button>
                <button type="reset" class="cancelbtn">Cancel</button>
            </div>
        </form>
        </center>
    </section>

</body>
</html>