<?php
  session_start();
  include('../db_connect.php');
  include('head.php');

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
</head>
<body>
    <section class="banner-section">
        <img src="images/banner2.jpg" alt="" >
        <h1 class="centered">Staff</h1>
    </section>
    <section class="viewFund">
        <h2 style="padding-left:20px;">List of Staff Member</h2>
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for staff.." title="Type in a name">
        <table id="myTable">
            <tr class="header">
                <th style="width:20%;">Staff Name</th>
                <th style="width:20%;">Staff Email</th>
                <th style="width:20%;">Staff ContactNo</th>
                <th style="width:20%;">Staff Type</th>
                <th style="width:15%;">View</th>
                <th style="width:15%;">Delete</th>
            </tr>
            <tr>
            <?php
                        $query = "SELECT * FROM member WHERE userType='employee'";
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) 
                        {
                            foreach($query_run as $row)
                            {
                              //displaying all data in db
                              ?>
                                <td><?php echo $row['fullName']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['contactNo']; ?></td>
                                <td><?php echo $row['userType']; ?></td>
                                <td>
                                <a class="button buttonEdit" href="staffDetail.php?userID=<?php echo $row['userID']; ?>">View</a>
                                </td>
                                <td>
                                <form action="code.php" method="post">
                                <input type="hidden" name="userID" id="userID" value="<?php echo $row['userID']; ?>">
                                <button  type="submit" name="deleteStaff" class="button buttonDelete">Delete</button>
                                </form>
                                </td>
                                </tr>
                            <?php
                         }
                        }
                    ?>
        </table>
    </section>
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
</body>
</html>