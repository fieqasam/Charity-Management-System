<?php 
session_start();
include('../db_connect.php');

//add new campaign
if (isset($_POST['addCampaign'])) {
    
    $title = $_POST['title'];
    $bannerImage = $_FILES['bannerImage']['name'];
    $description = $_POST['description'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $amountFund = $_POST['amountFund'];
    $status = $_POST['status'];
    $userID = $_POST['userID'];
    $filename = $_FILES['bannerImage']['name'];
    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);

    if (file_exists("../Admin/campaignImage/".$_FILES['bannerImage']['name'])) {
        
        $filename = $_FILES['bannerImage']['name'];
        echo "<script type='text/javascript'>alert('Image already exist!'.$filename);</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = " fundraiser.php";</script>';

    }
    else {
        $query = "INSERT INTO fundrisercampaignn(title,bannerImage,description,startDate,endDate,amount,status,userID) VALUES ('$title','$bannerImage','$description','$startDate','$endDate','$amountFund','$status', '$userID')";
        $query_run = mysqli_query($con, $query);

            if ($query_run) 
            {
                move_uploaded_file($_FILES["bannerImage"]["tmp_name"], "../Admin/campaignImage//".$_FILES["bannerImage"]["name"]);
                echo "<script type='text/javascript'>alert('You have success add new campaign!');</script>";
                echo '<style>body{display:none;}</style>';
                echo '<script>window.location.href = " fundraiser.php";</script>';
            }
            else{
                echo "<script type='text/javascript'>alert('You have failed to add new campaign!');</script>";
                echo '<style>body{display:none;}</style>';
                echo '<script>window.location.href = " fundraiser.php";</script>';
            } 
    }


}

//addnew staff
if (isset($_POST['addStaff'])) {

    $staffType = $_POST['staffType'];
    $staffName = $_POST['staffName'];
    $username = $_POST['username'];
    $staffEmail = $_POST['staffEmail'];
    $staffContact = $_POST['staffContact'];
    $staffPass = $_POST['staffPass'];
    $staffStatus = $_POST['staffStatus'];

    $staffPass = md5($staffPass);

    $query = "INSERT INTO member(fullName, email, contactNo, password, userType, username) VALUES ('$staffName','$staffEmail', '$staffContact', '$staffPass', '$staffType', '$username')";
    $query_run = mysqli_query($con, $query);

        if ($query_run) 
        {
            echo "<script type='text/javascript'>alert('You have success add new staff!');</script>";
            echo '<style>body{display:none;}</style>';
            echo '<script>window.location.href = "addStaff.php";</script>';
        }
        else{
            echo "<script type='text/javascript'>alert('You have failed to add new staff!');</script>";
            echo '<style>body{display:none;}</style>';
            echo '<script>window.location.href = "addStaff.php";</script>';
        } 

}

if(isset($_POST['updateProfile'])){

    $userId =$_POST['userId'];
    $staffType =$_POST['staffType'];
    $fullName = $_POST['fullName'];
    $userEmail = $_POST['userEmail'];
    $userContact = $_POST['userContact'];

    $username = $_SESSION['auth_user']['username'];
    $password = $_SESSION['auth_user']['password'];

    $sql = "UPDATE member SET fullName='".$fullName."', email='".$userEmail."', contactNo='".$userContact."' WHERE username='$username' AND password='$password'";
    $result = $con->query($sql);

    if ($con->query($sql) === TRUE) {
        echo "<p style='text-align:center'>Data $fullName have been updated!";
        echo "<meta http-equiv=\"refresh\" content=\"3;URL=profile.php\">";
        echo "</p>";
    } else {
        echo "<p style='text-align:center'>Error: ".$sql. "<br>" . $conn->error;
    }
}

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

//update campaign section
if (isset($_POST['updateCampaign'])) 
{
    $campaignID=$_POST['campaignID'];
    $title = $_POST['title'];
    $bannerImage = $_FILES['bannerImage']['name'];
    $oldBannerImage = $_POST['oldBannerImage'];
    $description = $_POST['description'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $amountFund = $_POST['amountFund'];
    $status = $_POST['status'];
    
    $allowed_extension = array('gif', 'png', 'jpg', 'jpeg');
    $filename = $_FILES['bannerImage']['name'];
    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);

    if (!in_array($file_extension, $allowed_extension)) {
        echo "<script type='text/javascript'>alert('You are allowed with only jpg, png, jpeg, and gif');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "fundList.php";</script>';
    }else {
       $query_update = "UPDATE fundrisercampaignn SET title='$title', bannerImage='$bannerImage', description='$description', startDate='$startDate', endDate='$endDate', amount='$amountFund', status='$status' WHERE campaignID='$campaignID'";
       $query_run = mysqli_query($con, $query_update);

       if ($query_run) {
        unlink("../Admin/campaignImage/".$oldBannerImage);
        move_uploaded_file($_FILES["bannerImage"]["tmp_name"], "../Admin/campaignImage/".$_FILES["bannerImage"]["name"]);
        echo "<script type='text/javascript'>alert('You have success update the campaign!');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "fundList.php";</script>';
       }else {
        echo "<script type='text/javascript'>alert('You have failed to update the campaign!');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "fundList.php";</script>';
       }

    }

}

//delete campaign details
if (isset($_POST['deleteCampaign'])) {
   $campaignID = $_POST['campaignID'];
   $deleteBanner = $_POST['deleteBanner'];

   $query = "DELETE FROM fundrisercampaignn WHERE campaignID='$campaignID'";
   $query_run = mysqli_query($con, $query);

   if ($query_run) 
   {
    unlink("../Admin/campaignImage/".$deleteBanner);
    echo "<script type='text/javascript'>alert('You have success delete the campaign!');</script>";
    echo '<style>body{display:none;}</style>';
    echo '<script>window.location.href = "fundList.php";</script>';
   }else {
    echo "<script type='text/javascript'>alert('You have failed delete the campaign!');</script>";
    echo '<style>body{display:none;}</style>';
    echo '<script>window.location.href = "fundList.php";</script>';
   }

}

//delete staff
if (isset($_POST['deleteStaff'])) {
    
    $userID = $_POST['userID'];

    $query = "DELETE FROM member WHERE userID='$userID'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        echo "<script type='text/javascript'>alert('You have success delete the staff!');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "viewStaff.php";</script>';
    }else {
        echo "<script type='text/javascript'>alert('You have failed delete the staff!');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "viewStaff.php";</script>';
    }
}
//add member type
if (isset($_POST['addMemberType'])) {
    
    $memberType = $_POST['memberType'];
    $descriptionMember = $_POST['descriptionMember'];
    $memberStatus = $_POST['memberStatus'];

    $query="INSERT INTO memberCategory(memberType, descriptionMember, memberStatus) VALUES('$memberType', '$descriptionMember', '$memberStatus')";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        echo "<script type='text/javascript'>alert('You have success add new member category!');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "memberType.php";</script>';
    }else {
        echo "<script type='text/javascript'>alert('You have failed to add new member category!');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "memberType.php";</script>';
    }

}
//add member info
if (isset($_POST['addMemberInfo'])) 
{
    $userID= $_POST['userID'];
    $memberType = $_POST['memberType'];
    $memberName = $_POST['memberName'];
    $memberImage = $_FILES['memberImage']['name'];
    $addressMember = $_POST['addressMember'];
    $contactMember = $_POST['contactMember'];
    $descriptionMember = $_POST['descriptionMember'];
    $statusMember = $_POST['statusMember'];
    $supportFile = $_FILES['supportFile']['name'];

    $allowed_extension = array('gif', 'png', 'jpg', 'jpeg');

    
    $filename = $_FILES['memberImage']['name'];
    $filename2 = $_FILES['supportFile']['name'];

    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
    $file_extension = pathinfo($filename2, PATHINFO_EXTENSION);

    if (!in_array($file_extension, $allowed_extension)) {
       
        echo "<script type='text/javascript'>alert('You are allowed with only jpg, png, jpeg, and gif');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "registerNewHouse.php";</script>';
    }
    else {
        $sql = "INSERT INTO  membercharity(memberType, memberName, memberImage, supportFile, addressMember, contactMember, descriptionMember, statusMember, userID) 
        VALUES('$memberType', '$memberName', '$memberImage', '$supportFile', '$addressMember', '$contactMember', '$descriptionMember', '$statusMember', '$userID')";
        $sql_run = mysqli_query($con, $sql);

        if ($sql_run) {
            move_uploaded_file($_FILES["memberImage"]["tmp_name"], "../Admin/memberImage/".$_FILES["memberImage"]["name"]);
            move_uploaded_file($_FILES["supportFile"]["tmp_name"], "../Admin/supportDocument/".$_FILES["supportFile"]["name"]);
            echo "<script type='text/javascript'>alert('You have sucess add new member!');</script>";
            echo '<style>body{display:none;}</style>';
            echo '<script>window.location.href = "addMember.php";</script>';
        }else {
            echo "<script type='text/javascript'>alert('You have failed to add new member!');</script>";
            echo '<style>body{display:none;}</style>';
            echo '<script>window.location.href = "addMember.php";</script>';
        }
    }

}

//update member info
if (isset($_POST['updateMemberInfo'])) {

    $charityID = $_POST['charityID'];
    $memberType = $_POST['memberType'];
    $memberName = $_POST['memberName'];
    $addressMember = $_POST['addressMember'];
    $contactMember = $_POST['contactMember'];
    $descriptionMember = $_POST['descriptionMember'];
    $statusMember = $_POST['statusMember'];

    $oldMemberImage = $_POST['oldMemberImage'];
    $memberImage = $_FILES['memberImage']['name'];

    $oldSupportFile = $_POST['oldSupportFile'];
    $supportFile = $_FILES['supportFile']['name'];

    $allowed_extension = array('gif', 'png', 'jpg', 'jpeg');
    $filename = $_FILES['memberImage']['name'];
    $filename = $_FILES['supportFile']['name'];
    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);

    if (!in_array($file_extension, $allowed_extension)) {
        echo "<script type='text/javascript'>alert('You are allowed with only jpg, png, jpeg, and gif');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "viewMember.php";</script>';
    }else {
        $query_update = "UPDATE membercharity SET memberType='$memberType', memberName='$memberName', memberImage='$memberImage', supportFile='$supportFile', addressMember='$addressMember', contactMember='$contactMember', descriptionMember='$descriptionMember', statusMember='$statusMember' WHERE charityID='$charityID'";
        $query_run = mysqli_query($con, $query_update);
 
        if ($query_run) {
         unlink("../Admin/memberImage/".$oldMemberImage);
         unlink("../Admin/supportDocument/".$oldSupportFile);
         move_uploaded_file($_FILES["memberImage"]["tmp_name"], "../Admin/memberImage/".$_FILES["memberImage"]["name"]);
         move_uploaded_file($_FILES["supportFile"]["tmp_name"], "../Admin/supportDocument/".$_FILES["supportFile"]["name"]);
         echo "<script type='text/javascript'>alert('You have success update the member info!');</script>";
         echo '<style>body{display:none;}</style>';
         echo '<script>window.location.href = "viewMember.php";</script>';
        }else {
         echo "<script type='text/javascript'>alert('You have failed to update the member info!');</script>";
         echo '<style>body{display:none;}</style>';
         echo '<script>window.location.href = "editMemberDetails.php";</script>';
        }
    }
}

//delete member info
if (isset($_POST['deleteMember'])) {

    $charityID= $_POST['charityID'];
    $deleteMemberDetails = $_POST['deleteMemberDetails'];
    $deleteFile = $_POST['deleteFile'];

    $query = "DELETE FROM memberCharity WHERE charityID='$charityID'";
    $query_run = mysqli_query($con, $query);
 
    if ($query_run) 
    {
     unlink("../Admin/memberImage/".$deleteMemberDetails);
     unlink("../Admin/supportDocument/".$deleteFile);
     echo "<script type='text/javascript'>alert('You have success delete the member info!');</script>";
     echo '<style>body{display:none;}</style>';
     echo '<script>window.location.href = "viewMember.php";</script>';
    }else {
     echo "<script type='text/javascript'>alert('You have failed delete the member info!');</script>";
     echo '<style>body{display:none;}</style>';
     echo '<script>window.location.href = "viewMember.php";</script>';
    }
}
//Close specified connection
$con->close();
?>
