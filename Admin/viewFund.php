<?php 
session_start();
include('head.php');
include('../db_connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity Management System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <section class="banner-section">
    <img src="images/banner2.jpg" alt="" >
        <h1 class="centered">Fund Raiser</h1>
    </section>
    <section class="viewFund">
        <h2 style="padding-left:20px;">View Fund Collection</h2>
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for fund.." title="Type in a name">
        <table id="myTable">
            <tr class="header">
                <th style="width:20%;">Fund Raiser Detail</th>
                <th style="width:20%;">Donor Detail</th>
                <th style="width:10%;">Paid Date</th>
                <th style="width:20%;">Payment Detail</th>
                <th style="width:10%;">Paid Amount</th>
                <th style="width:20%;">Action</th>
            </tr>
            <tr>
                <td>Data</td>
                <td>Data</td>
                <td>Data</td>
                <td>Data</td>
                <td>Data</td>
                <td>
                <button class="button button4" name="print">Print</button>
                </td>
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