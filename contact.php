<?php 
session_start();
include('includes/head.php');
include('db_connect.php');

?>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/contact.css">
</head>
<body>
    <section class="banner-section">
        <img src="images/banner.jpg" alt="">
        <div class="centered"><h1>Contact</h1></div>
    </section>
    <section class="contact-container">
        <h2>Get In Touch</h2>
        <div class="container">
            <form action="email.php" method="post">
                <label for="">Enter your name</label>
                <input type="text" id="name" name="name" placeholder="your name..">
                <label for="">Enter your Email</label>
                <input type="hidden" id="recipient" name="recipient" value="houserentalsystem34@gmail.com">
                <input type="email" id="email" name="email">
                <label for="">Enter your subject</label>
                <input type="text" name="subject" id="subject" placeholder="" > 
                <label for="">Enter Message</label>
                <textarea id="message" name="message" placeholder="Write something.." style="height:200px"></textarea>
                <input type="submit" name="submitContact" value="Submit">
            </form>
        </div>

    </section>
<?php include('includes/footer.php'); ?>
</body>
</html>