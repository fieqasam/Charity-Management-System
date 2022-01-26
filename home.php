<?php
session_start();
include('includes/head.php');
?>
<html lang="en">
<body>
    <section class="container-info">
           <img src="images/help-people.jpg" alt="lep people" style="width:100%;">
           <div class="top-left">
            <div class="syle-h1">
                <h1>Give a helping hand to those who need it!</h1>
                <p>When a child gets access to good food, it can change just about everything.</p>
               </div>
                <button class="button"><a href="aboutUs.php">Learn More About us </a></span></button>
                <button class="button"><span><a href="register.php">Join us </a></span></button>
           </div>
    </section>
    <section class="program-info">
        <img src="images/program1.jpg" alt="lep people" style="width:35%;">
        <div class="program-sub">
            <p style="color: #54cfbf;font-size: 16px;font-weight: 400;margin-bottom: 0px; text-transform: capitalize; display: inline-block;">
                <b>Upcoming Program</b>    
            </p>
            <h2>Donate vitamin B12 supply program</h2>
            <p>When a child gets access to good food, it can change just about everything.
                Sed do eiusmod tempor incididunt dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation
            </p>
            <button class="button"><span>Donate Now</span></button>
            <button class="button"><span>View Programs</span></button>
        </div>
    </section>
 <?php
include('includes/footer.php');
?>
</body>
</html>


