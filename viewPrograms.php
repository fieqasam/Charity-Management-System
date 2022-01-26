<?php 
session_start();
include('includes/head.php');
include('db_connect.php');
//Get the current session
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
   <style>
       body{
        font-family: Verdana, sans-serif;
       }
       h1{
           font-size:40px;
       }

       .gallery{
           width:30%;
           
       }

       p{
           margin-right:60px;
           margin-left:60px;
           font-size:20px;
           text-align:justify;
           text-indent: 1.0em;
       }

       .info {
        background-color: #87CEEB;
        border-left: 3px solid #2196F3;
        margin-bottom: 15px;
        padding: 4px 12px;
        margin-left:50px;
        margin-right:20px;
        
        }

        .info-description{
            margin-left:30px;
            font-size:17px;
            text-indent: 0em;
        }

        #myTable {
        border-collapse: collapse;
        width: 100%;
        border: 1px solid #ddd;
        font-size: 18px;
    }
    #myTable2 {
        border-collapse: collapse;
        width: 100%;
        font-size: 18px;
    }
    #myTable2 th, #myTable2 td {
        text-align: left;
        padding: 12px;
    }

    #myTable th, #myTable td {
        text-align: left;
        padding: 12px;
    }
    
    #myTable tr {
        border-bottom: 1px solid #ddd;
    }
    
    #myTable tr.header, #myTable tr:hover {
        background-color: #f1f1f1;
    }
    input[type=text],input[type=email], input[type=number],select, textarea {
   
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 6px;
    margin-bottom: 16px;
    resize: vertical;
    }

    input[type=submit] {
    font-size:18px;
    background-color: #04AA6D;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    }

    input[type=submit]:hover {
    background-color: #45a049;
    }

    /* Create three equal columns that floats next to each other */
    footer .column {
    float: left;
    width: 25%;
    padding: 10px;
    height: 260px;
    /* Should be removed. Only for demonstration */
    }
    
   </style>
</head>
<body>
    <?php 
    if (isset($_GET['campaignID'])) {

        $campaignID = $_GET['campaignID'];

        $query_select="SELECT * FROM fundrisercampaignn WHERE campaignID='$campaignID'";
        $query_run = mysqli_query($con, $query_select);

        if (mysqli_num_rows($query_run)>0) {
           
            foreach ($query_run as $row) {
                
                ?>
              
                    <center>
                    <h1><?php echo $row['title']; ?></h1>
                    <div class="gallery">
                    <a target="_blank" href="Admin/campaignImage/<?=$row['bannerImage']?>">
                        <img class="program-pic" src="Admin/campaignImage/<?=$row['bannerImage']?>">
                    </a>
                    </div>
                    <div class="description">
                        <p>
                            <?php echo $row['description'] ;?>
                        </p>
                    </div>
                    </center>
                <?php
            }
        }
    }
       
    ?>
    <center>
    <div class="info">
    <p class="info-description"><strong>Perhatian!</strong> Sila lengkapkan borang dibawah </p>
    </div>
    <p style="color:red; font-size:17px;">*Ruagan wajib diisi</p>
    </center>
   <section>
          <hr style="border-top: dotted 2px;">
          <h4>BUTIRAN PENYUMBANG</h4>
          <hr style="border-top: dotted 2px;">
          <table width="80%" id="myTable2">
          <form action="process-program.php" method="post">
              <tr>
                  <td>Fullname*</td>
                  <td><input type="text" name="name" id="name" required></td>
              </tr>
              <tr>
                  <td>Email Address*</td>
                  <td><input type="text" name="email" id="email" required></td>
              </tr>
              <tr>
                  <td>Phone Number*</td>
                  <td><input type="text" name="contactNo" id="contactNo" required></td>
              </tr>
              <tr>
                  <td>Short Note</td>
                  <td><input type="text" name="note" id="note" required>
                  <input type="hidden" name="userId" id="userId" value="<?php echo $userID; ?>">
                </td>
              </tr>
              <tr>
                  <td>Amount Donate</td>
                  <td><input type="text" name="amountDonate" id="amountDonate" required>
                  <input type="hidden" name="campaignID" id="campaignID" value="<?php echo $campaignID; ?>">
                </td>
              </tr>
              <tr>
                  <td>
                      <input type="submit" name="submitDonation" value="Donate Now">
                  </td>
              </tr>

          </table>
      </form>
   </section>
</body>
</html>