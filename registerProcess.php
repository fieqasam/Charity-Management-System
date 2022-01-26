<?php 
session_start();
include('db_connect.php');

    $fullName = $_POST['name'];
    $email = $_POST['email'];
    $phoneNo = $_POST['phoneNo'];
    $password = $_POST['password'];
    $confirmPass = $_POST['confirmpass'];
    $userType = $_POST['userType'];
    $username = $_POST['username'];

     //insert data into database
    $password = md5($password);
    $query_insert = "INSERT INTO member(fullName,email,contactNo,password, userType, username) VALUES ('$fullName','$email','$phoneNo','$password','$userType', '$username')";
        
    if ($con->query($query_insert) == TRUE) {
        echo "New record created successfully";
        echo "<meta http-equiv=\"refresh\" content=\"3;URL=login.php\">";
    }
    else {
        echo "Error: ".$sql_insert. "<br>" .$conn->error;
    }
        
//closes specific connection
$con->close();
?>