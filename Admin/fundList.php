<?php
  session_start();
  include('../db_connect.php');
  include('head.php');
//save the current session
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
<html lang="en">
<head>
    <title>Charity Management System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
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
    <img src="images/banner2.jpg" alt="" >
        <h1 class="centered">Fund Raiser</h1>
    </section>
    <section class="viewFund">
        <h2 style="padding-left:20px;">View Fund Raiser</h2>
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for fund.." title="Type in a name">
        <table id="myTable">
            <tr class="header">
                <th style="width:20%;">Banner</th>
                <th style="width:20%;">Title</th>
                <th style="width:10%;">Fund Amount (RM)</th>
                <th style="width:10%;">Start Date</th>
                <th style="width:10%;">End Date</th>
                <th style="width:10%;">Status</th>
                <th style="width:15%;">Update</th>
                <th style="width:15%;">Delete</th>
            </tr>
            <tr>
                 <?php
                        $query = "SELECT * FROM fundrisercampaignn";
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
                            <td><?php echo $row['amount']; ?></td>
                            <td><?php echo $row['startDate']; ?></td>
                            <td><?php echo $row['endDate']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td>
                            <a class="button buttonEdit" href="editCampaign.php?campaignID=<?php echo $row['campaignID']; ?>">Edit</a>
                            </td>
                            <td>
                            <form action="code.php" method="post">
                            <input type="hidden" name="campaignID" id="campaignID" value="<?php echo $row['campaignID']; ?>">
                            <input type="hidden" name="deleteBanner" value="<?php echo $row['bannerImage']; ?>">
                            <button  type="submit" name="deleteCampaign" class="button buttonDelete">Delete</button>
                            </form>
                            </td>
                        </tr>
                        <?php
                         }
                        }
                    ?>
        </table>
    </section>

</body>
</html>