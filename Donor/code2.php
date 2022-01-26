<?php 
session_start();
include('../db_connect.php');

//update user profile
if(isset($_POST['updateProfile'])){

    $userId =$_POST['userId'];
    $staffType =$_POST['staffType'];
    $fullName = $_POST['fullName'];
    $userEmail = $_POST['userEmail'];
    $userContact = $_POST['userContact'];
    $username = $_POST['username'];
    $username = $_SESSION['auth_user']['username'];
    $password = $_SESSION['auth_user']['password'];

    $sql = "UPDATE member SET fullName='".$fullName."', email='".$userEmail."', contactNo='".$userContact."',username='".$username."' WHERE userID='$userId'";
    $result = $con->query($sql);

    if ($con->query($sql) === TRUE) {
        echo "<script type='text/javascript'>alert('Data $fullName have been updated!');</script>";
        echo "<meta http-equiv=\"refresh\" content=\"3;URL=manageProfile.php\">";
        echo "</p>";
    } else {
        echo "<p style='text-align:center'>Error: ".$sql. "<br>" . $conn->error;
    }
}
//change user password
if (isset($_POST['ChangePass'])) {

    $oldPass2 = $_POST['oldPass'];
    $newPass = $_POST['newPass'];
    $username = $_SESSION['auth_user']['username']; 
    $password = $_SESSION['auth_user']['password']; 
    //hashed password
    $newPass = md5($newPass);

    //check whether new password == current password
   if ($oldPass2 == $newPass) {

    $newPass = md5($newPass);

    echo "<script type='text/javascript'>alert('New Passsword can't be same with old password!');</script>";
    echo '<style>body{display:none;}</style>';
    echo '<script>window.location.href = "changePass.php";</script>';

   }else {
       //update the new password into db
       $sql_update = "UPDATE member SET password='".$newPass."' WHERE username='$username' AND password='$password'";
       $result = $con->query($sql_update);

       if ($con->query($sql_update) === TRUE) {
            echo "<p style='text-align:center'>Your new password have been updated! please login again.";
            echo "<meta http-equiv=\"refresh\" content=\"3;URL=../login.php\">";
            echo "</p>";
       }else {
        echo "<script type='text/javascript'>alert('New Passsword cant be update! try again.');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "changePass.php";</script>';
       }
   }

}

mysqli_close($con);
?>