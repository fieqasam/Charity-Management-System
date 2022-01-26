<?php 
session_start();
include('head.php');
include('../db_connect.php');

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
    <link rel="stylesheet" type="text/css" href="style2.css">
    <script>
      function fileValidation(){
        var fileInput = document.getElementById('memberImage');
        var filePath = fileInput.value;
        //Allowing file type
        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        if (!allowedExtensions.exec(filePath)) {
                alert('Invalid file type');
                fileInput.value = '';
                return false;
            } 
            else{
              // Image preview
              if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById(
                            'imagePreview').innerHTML = 
                            '<img src="' + e.target.result
                            + '"/>';
                    };
                      
                    reader.readAsDataURL(fileInput.files[0]);
                }
            }
      }
      function validateForm() {

        let name = document.forms["myForm"]["memberName"].value;
        let image = document.forms["myForm"]["memberImage"].value;
        let address = document.forms["myForm"]["addressMember"].value;
        let contactNo =  document.forms["myForm"]["contactMember"].value;
        let description = document.forms["myForm"]["descriptionMember"].value;

        if (name == "") {
          alert("Name must be filled out");
          return false;
        }
        else if (address == "") {
          alert("Address must be filled out");
          return false;
        }
        else if (contactNo == "") {
          alert("Contact Number must be filled out");
          return false;
        }
        else if (description == "") {
          alert("Description must be filled out");
          return false;
        }
        
      }
    </script>
</head>
<body>
    <section class="banner-section">
        <img src="images/banner2.jpg" alt="" >
        <h1 class="centered">Member</h1>
    </section>
    <section class="newFund-section">
        <h2 style="padding-left:20px;">Update Member Info</h2>
        <div class="container">
          <form action="code.php" name="myForm" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
          <div class="row">
              <div class="col-25">
                <label for="">Member Type</label>
              </div>
              <div class="col-75">
                <?php 
                if (isset($_GET['charityID'])) {

                    $charityID = $_GET['charityID'];

                    $query="SELECT * FROM membercharity WHERE charityID='$charityID'";
                    $query_run = mysqli_query($con, $query);
                    $query_type = "SELECT * FROM membercategory";
                    $query_type_run = mysqli_query($con, $query_type);

                    if (mysqli_num_rows($query_run)>0) {
                        
                        foreach ($query_run as $row) {
                            ?>
                            <select name="memberType" id="memberType">
                            <option selected ><?php echo $row['memberType']; ?></option>
                            <?php while($row1 = mysqli_fetch_array($query_type_run)):;?>
                            <option value="<?php echo $row1['memberType'];?>"><?php echo $row1['memberType'];?></option>
                            <?php endwhile; ?> 
                            </select>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-25">
                                <label for="">Name</label>
                            </div>
                            <div class="col-75">
                                <input type="text" name="memberName" id="memberName" value="<?php echo $row['memberName']; ?>">
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-25">
                                <label for="">Image</label>
                            </div>
                            <div class="col-75">
                                <input type="text" name="oldMemberImage" id="oldMemberImage" value="<?php echo $row['memberImage']; ?>"> <br><br>
                                <input type="file" name="memberImage" id="memberImage"  onchange="return fileValidation()"  value="<?php echo $row['memberImage']; ?>">
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-25">
                                <label for="">Support Document</label>
                            </div>
                            <div class="col-75">
                                <input type="text" name="oldSupportFile" id="oldSupportFile" value="<?php echo $row['supportFile']; ?>"><br><br>
                                <input type="file" name="supportFile" id="supportFile"  onchange="return fileValidation()" value="<?php echo $row['supportFile']; ?>">
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-25">
                                <label for="">Address</label>
                            </div>
                            <div class="col-75">
                                <input type="text" name="addressMember" id="addressMember" style="height:50px" value="<?php echo $row['addressMember']; ?>">
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-25">
                                <label for="">Contact Number</label>
                            </div>
                            <div class="col-75">
                                <input type="text" name="contactMember" id="contactMember" value="<?php echo $row['contactMember']; ?>">
                                <input type="hidden" name="charityID" id="charityID" value="<?php echo $charityID; ?>">
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-25">
                                <label for="">Description</label>
                            </div>
                            <div class="col-75">
                                <input type="text"  name="descriptionMember" id="descriptionMember" style="height:80px" value="<?php echo $row['descriptionMember']; ?>">
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-25">
                                <label for="">Status</label>
                            </div>
                            <div class="col-75">
                                <select name="statusMember" id="statusMember">
                                <option selected><?php echo $row['statusMember']; ?></option>
                                <option value="active"> Active</option>
                                <option value="not active"> Not Active</option>
                                </select>
                            </div>
                            </div>
                            <br>
                            <div class="row">
                            <input type="submit" name="updateMemberInfo" value="Update">
                            <input type="reset" name="resetMemberType" value="Reset">
                            </div>

                            <?php
                        }
                    }else {
                        echo "<h4>No record found!</h4>";
                    }
                }
                ?>
                
        </form>
        </div>
    </section>
</body>
</html>