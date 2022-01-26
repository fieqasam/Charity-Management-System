<?php
session_start();
include('head.php');
include('../db_connect.php');
//save current session
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
        <h1 class="centered">Member</h1>
    </section>
    <section class="viewFund">
        <h2 style="padding-left:20px;">List of Members</h2>
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for member.." title="Type in a name">
        <table id="myTable">
            <tr class="header">
                <th style="width:20%;">Member Image</th>
                <th style="width:20%;">Support File</th>
                <th style="width:15%;">Member Name</th>
                <th style="width:10%;">Member Type</th>
                <th style="width:10%;">Meber Status</th>
                <th style="width:10%;">Update</th>
                <th style="width:10%;">Delete</th>
            </tr>
            
                <?php 
                $query = "SELECT * FROM membercharity WHERE userID='$userID'";
                $query_run = mysqli_query($con, $query);

                if (mysqli_num_rows($query_run) > 0) {
                    
                    foreach ($query_run as $row) {
                        
                        ?>
                        <tr>
                            <td>
                            <img src="../Admin/memberImage/<?=$row['memberImage']?>" style="width:40%;" >
                            </td>
                            <td>
                            <img src="../Admin/supportDocument/<?=$row['supportFile']?>" style="width:40%;" > 
                            </td>
                            <td><?php echo $row['memberName']; ?></td>
                            <td><?php echo $row['memberType']; ?></td>
                            <td><?php echo $row['statusMember']; ?></td>
                            <td>
                            <a class="button buttonEdit" href="editMemberDetails.php?charityID=<?php echo $row['charityID']; ?>">Edit</a>
                            </td>
                            <td>
                            <form action="code.php" method="post">
                            <input type="hidden" name="charityID" id="charityID" value="<?php echo $row['charityID']; ?>">
                            <input type="hidden" name="deleteMemberDetails" value="<?php echo $row['memberImage']; ?>">
                            <input type="hidden" name="deleteFile" value="<?php echo $row['supportFile']; ?>">
                            <button  type="submit" name="deleteMember" class="button buttonDelete">Delete</button>
                            </form>
                            </td>
                        <?php
                    }
                }
                ?>
            </tr>

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