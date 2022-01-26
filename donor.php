<?php

    session_start();

    if(isset($_SESSION['donorEmail']))
    {
        echo ' WellCome ' . $_SESSION['donorEmail'].'<br/>';
        echo '<a href="logout.php?logout">Logout</a>';
    }
    else
    {
        header("location:login.php");
    }

?>