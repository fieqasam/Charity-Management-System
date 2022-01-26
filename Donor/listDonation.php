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
    $username = $_SESSION['auth_user']['username'];
    $password = $_SESSION['auth_user']['password'];
  }
  else
  {
     echo "Not Logged In";
  }
?>
<html lang="en">
<head>
    <title>Charity Management System</title>
    <link rel="stylesheet" type="text/css" href="style2.css">
    <script>
    function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i <script tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
        }       
    }
    }
</script>
</head>
<body>
    <section class="banner-section">
    <img src="../Admin/images/banner2.jpg" alt="" >
        <h1 class="centered">Donation</h1>
    </section>
    <section class="viewFund">
        <h2 style="padding-left:20px;">List of Donation</h2>
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for fund.." title="Type in a name">
        <table id="myTable">
            <tr class="header">
                <th style="width:20%;">BannerImage</th>
                <th style="width:20%;">Donation Name</th>
                <th style="width:20%;">Donation Amount (RM)</th>
                <th style="width:10%;">Date</th>
                <th style="width:10%;">Status</th>
                <th style="width:15%;">View</th>
                <th style="width:15%;">Print</th>
            </tr>
            <tr>
                 <?php
                        $query = "SELECT * FROM donationcharity INNER JOIN fundrisercampaignn ON donationcharity.campaignID=fundrisercampaignn.campaignID WHERE donationcharity.userID LIKE $userID";
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) 
                        {
                         //loop every iteration until last element
                         //for displaying all data once new data insert
                         foreach($query_run as $row)
                         {
                           //displaying all data in db
                           ?>
                            <td>
                            <img src="../Admin/campaignImage/<?=$row['bannerImage']?>" style="width:50%;" >
                            </td>
                            <td><?php echo $row['title']; ?></td>
                            <td><?php echo $row['amountDonate']; ?></td>
                            <td><?php echo $row['date']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td>
                            <a class="button buttonEdit" href="viewDonation.php?donateID=<?php echo $row['donateID']; ?>">View</a>
                            </td>
                            <td><a class="button buttonEdit" href="printDonors.php?donateID=<?php echo $row['donateID']; ?>">Print</a></td>
                        </tr>
                        <?php
                         }
                        }
                    ?>
        </table>
    </section>

</body>
</html>