<?php 
session_start();
include('head.php');
include('../db_connect.php');

$username = $_SESSION['auth_user']['username'];
$password = $_SESSION['auth_user']['password'];
$userID = $_SESSION['auth_user']['userID'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style2.css">
    <script>
        function fileValidation(){
        var fileInput = document.getElementById('bannerImage');
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

      let title = document.forms["myForm"]["title"].value;
      let image = document.forms["myForm"]["bannerImage"].value;
      let description = document.forms["myForm"]["description"].value;
      let startDate =  document.forms["myForm"]["startDate"].value;
      let endDate = document.forms["myForm"]["endDate"].value;
      let amountFund = document.forms["myForm"]["amountFund"].value;
      
      if (title == "") {
        alert("Title must be filled out");
        return false;
      }
      else if (image == "") {
        alert("Image must be selected");
        return false;
      }
      else if (description == "") {
        alert("Description must be filled out");
        return false;
      }
      else if (startDate == "") {
        alert("Start Date must be filled out");
        return false;
      }
      else if (endDate == "") {
        alert("End Date must be filled out");
        return false;
      }
      else if (amountFund == "") {
        alert("Amount Fund must be filled out");
        return false;
      }

      }
    </script>
</head>

<body>
  
    <section class="banner-section">
        <img src="images/banner2.jpg" alt="" >
        <h1 class="centered">Fund Raiser</h1>
    </section>
    <section class="newFund-section">
        <h2 style="padding-left:20px;">Add New Fund Raiser</h2>
        <div class="container">
          <form action="code.php" name="myForm" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <div class="row">
              <div class="col-25">
                <label for="">Title</label>
              </div>
              <div class="col-75">
                <input type="text" name="title" id="title" placeholder="title">
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for="">Banner Image</label>
              </div>
              <div class="col-75">
                <input type="file" name="bannerImage" id="bannerImage" onchange="return fileValidation()">
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for="">Description</label>
              </div>
              <div class="col-75">
                <textarea name="description" id="description" style="height:200px"placeholder="write something..."></textarea>
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for="">Start Date</label>
              </div>
              <div class="col-75">
                <input type="date" name="startDate" id="startDate">
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for="">End Date</label>
              </div>
              <div class="col-75">
                <input type="date" name="endDate" id="endDate">
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for="">Amount (RM)</label>
              </div>
              <div class="col-75">
                <input type="text" name="amountFund" id="amountFund">
                <input type="hidden" name="userID" value="<?php echo $userID; ?>">
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for="">Status</label>
              </div>
              <div class="col-75">
                <select name="status" id="status">
                  <option value="active"> Active</option>
                  <option value="not active"> Not Active</option>
                </select>
              </div>
            </div>
            <br>
            <div class="row">
              <input type="submit" name="addCampaign" value="Submit">
              <input type="reset" value="Reset">
            </div>
        </form>
        </div>
    </section>

    <footer>

    </footer>
</body>
</html>