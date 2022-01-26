<?php 
session_start();
include('db_connect.php');

if (isset($_POST['loginBtn'])) {
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = md5($password);

    $log_query = "SELECT * FROM member WHERE username='$username' AND password='$password'";
    $result = $con->query($log_query);

    if ($result->num_rows > 0) {
        
        while ($row = $result->fetch_assoc()) {
            
            $userID = $row['userID'];
            $fullName = $row['fullName'];
            $email = $row['email'];
            $contactNo = $row['contactNo'];
            $password = $row['password'];
            $userType = $row['userType'];
            $username = $row['username'];
        }

        $_SESSION['auth'] = "$userType";
        $_SESSION['auth_user'] = [
            'userID'=>$userID,
            'fullName'=>$fullName,
            'email'=>$email,
            'contactNo'=>$contactNo,
            'password'=>$password,
            'username'=>$username,
            'userType'=>$userType
        ];

        if ($_SESSION['auth'] == "admin") {
            
            echo "<script type='text/javascript'>alert('Logged in successfully!');</script>";
            echo '<style>body{display:none;}</style>';
            echo '<script>window.location.href = "Admin/dashboard.php";</script>';
            exit(0);
        }
       elseif ($_SESSION['auth'] == "donor") {
           
        $userid_query = "SELECT * FROM member WHERE userID LIKE $userID;";
        $result = $con->query($userid_query);

        if ($result->num_rows> 0) {
            
            echo "<script type='text/javascript'>alert('Welcome to charity system,$fullName');</script>";
            echo '<style>body{display:none;}</style>';
            echo '<script>window.location.href = "Donor/donorHome.php";</script>';
            exit(0);
        }
        else {
                echo "<script type='text/javascript'>alert('You need to register first!');</script>";
                echo '<style>body{display:none;}</style>';
                echo '<script>window.location.href = "login.php";</script>';
                session_unset();
        }
       }

    }else {
        echo "<script type='text/javascript'>alert('Invalid email or password!');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "login.php";</script>';
    }
}
//close specificed connection
$con->close(); 
?>