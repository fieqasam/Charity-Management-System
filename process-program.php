<?php 
include('db_connect.php');

if (isset($_POST['submitDonation'])) {

    $userID = $_POST['userId'];
    $name= $_POST['name'];
    $email = $_POST['email'];
    $contactNo = $_POST['contactNo'];
    $note = $_POST['note'];
    $date = date('y-m-d h:i:s');  
    $amountDonate = $_POST['amountDonate'];  
    $campaignID = $_POST['campaignID'];
    $status = "active"; 

    $query = "INSERT INTO donationcharity(name, email, contactNo, note, date, amountDonate,status,userID,campaignID) VALUES('$name', '$email', '$contactNo', '$note', '$date', '$amountDonate', '$status', '$userID','$campaignID')";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        
      echo '<script>alert("Your donation have successfully record in database!")</script>';
      echo '<script>window.location.href="viewPrograms.php";</script>';

    }else {
        echo '<script>alert("Failed! your donation have not been record in database.")</script>';
        echo '<script>window.location.href="viewPrograms.php";</script>';
    }
}

//close connection
mysqli_close($con);
?>