<?php 
session_start();
include('includes/head.php');
include('db_connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <style>
    body {
      font-family: Verdana, sans-serif;
      margin: 0;
    }

    * {
      box-sizing: border-box;
    }

    .row > .column {
      padding: 0 5px;
    }

    .row:after {
      content: "";
      display: table;
      clear: both;
    }

    .column {
      float: left;
      width: 30%;
      margin-bottom:200px;
    }
    /*buuton section */
    .button-program{
    font-family: "Rubik",sans-serif;
    text-transform: uppercase;
    border-radius: 4px;
    background-color: #228B22;
    border: none;
    color: #ffffff;
    text-align: center;
    font-size: 13px;
    padding: 15px;
    width:250px;
    transition: all 0.5s;
    cursor: pointer;
    margin: 0px;
}
.button-program span{
    cursor: pointer;
    display: inline-block;
    position: relative;
    transition: 0.5s;
}

.button-program span::after{
    content: '\00bb';
    position: absolute;
    opacity: 0;
    top: 0;
    right: -20px;
    transition: 0.5s;
}

.button-program:hover span{
    padding-right: 25px;
}

.button-program:hover span:after{
    opacity: 1;
    right: 0;
}

.button-program a{
    text-decoration: none;
    color: #ffffff;
}
  


  </style>
</head>
<body>
<section class="banner-section">
        <img src="images/banner.jpg" alt="">
        <div class="centered"><h1>Programs</h1></div>
  </section>
  <section>
  <center>
    <h2>Ongoing Program</h2>
  </center>
  <div class="row">
  <?php 
   $query = "SELECT * FROM fundrisercampaignn WHERE status='active'";
   $query_run = mysqli_query($con, $query);
 
   if (mysqli_num_rows($query_run) > 0) {

    foreach ($query_run as $row) {
      
      ?>
      <div class="row">
      <div class="column">
        <img src="Admin/campaignImage/<?=$row['bannerImage']?>" style="width:80%" onclick="openModal();currentSlide(1)" class="hover-shadow cursor">
        <button class="button-program"><a href="viewPrograms.php?campaignID=<?php echo $row['campaignID']; ?>">
        <?php echo $row['title']; ?> </a></span></button>
      </div>
      <?php
    }
   
   }
  ?>
   </div>
  </section>

  <?php include('includes/footer.php'); ?>
</body>
</html>