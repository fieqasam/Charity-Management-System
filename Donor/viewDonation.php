<?php 
session_start();
include('../db_connect.php');
include('head.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Charity Management System</title>
    <link rel="stylesheet" type="text/css" href="style2.css">
    <style>
     #myTable2 {
        border-collapse: collapse;
        border: 2px solid #C0C0C0;
        width: 50%;
        font-size: 18px;
    }
    #myTable2 th, #myTable2 td {
        border: 2px solid #C0C0C0;
        text-align: left;
        padding: 12px;
    }
    </style>
</head>
<body>
    <section class="banner-section">
    <img src="../Admin/images/banner2.jpg" alt="" >
        <h1 class="centered">Donation</h1>
    </section>
    <center>
    <table  width="50%" id="myTable2">
        <?php 
        if (isset($_GET['donateID'])) {
            
            $donateID = $_GET['donateID'];

            $query= "SELECT * FROM donationcharity INNER JOIN fundrisercampaignn ON donationcharity.campaignID=fundrisercampaignn.campaignID WHERE donationcharity.donateID LIKE $donateID";
            $query_run = mysqli_query($con, $query);

            if (mysqli_num_rows($query_run)>0) {
               foreach ($query_run as $row) {
                   
                ?>
                <tr>
                    <td>Name:</td>
                    <td><?php echo $row['name']; ?></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><?php echo $row['email']; ?></td>
                </tr>
                <tr>
                    <td>Conatact No:</td>
                    <td><?php echo $row['contactNo']; ?></td>
                </tr>
                <tr>
                    <td>Note:</td>
                    <td><?php echo $row['note']; ?></td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td><?php echo $row['date']; ?></td>
                </tr>
                <tr>
                    <td>Donation Amount (RM):</td>
                    <td><?php echo $row['amountDonate']; ?></td>
                </tr>
                <tr>
                    <td>Donation For:</td>
                    <td><?php echo $row['title']; ?></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <?php 
                        if ($row['status'] == "active") {
                            echo "Success";
                        }else{
                            echo "Failed";
                        }
                        ?>
                    </td>
                </tr>
                <?php
               }
            }
        }
        ?>
    </table>
    </center>
</body>
</html>