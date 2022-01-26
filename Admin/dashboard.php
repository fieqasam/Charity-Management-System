<?php 
session_start();
include('../db_connect.php');
include('head.php');

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
body {
  font-family: Arial, Helvetica, sans-serif;
  margin:0;
  padding:0;
}

/*navbar section */
.navbar {
  overflow: hidden;
  background-color: #4682b4;
}

.navbar a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 16px;  
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.navbar a:hover, .dropdown:hover .dropbtn {
  background-color: red;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {
  background-color: #ddd;
}

.dropdown:hover .dropdown-content {
  display: block;
}

.welcome-info{
  padding-left:20px;
  color:blue;
  text-transform:capitalize;
  font-weight:400;
}
</style>
</head>
<body>
    <section class="welcome-info">
      <h1>
        Welcome to charity management system, <?php echo $fullName ?>
      </h1>
    </section>
    <center>
    <section class="images-dashboard">
      <img src="../images/donate.jpg" alt="dashboard image" style="width:60%;">
    </section>
    </center>
    <footer>

    </footer>
</body>
</html>