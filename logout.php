<?php 
    session_start();
    if(isset($_GET['logout']))
    {
        session_destroy();
        $_SESSION = array();
        header("location:home.php");
    }

?>