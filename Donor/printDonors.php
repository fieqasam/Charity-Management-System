<?php 
include('../db_connect.php');
require('../fpdf184/fpdf.php');

if (isset($_GET['donateID'])) {
    
    $donateID = $_GET['donateID'];
}

//get invoice data
$query = "SELECT * FROM donationcharity INNER JOIN fundrisercampaignn ON donationcharity.campaignID=fundrisercampaignn.campaignID WHERE donationcharity.donateID LIKE $donateID";
$query_run = mysqli_query($con, $query);

$invoice = mysqli_fetch_array($query_run);

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 12);

//Cell(width , height , text , border , end line , [align] )
$pdf->Cell(130	,5,'CHARITY MANAGEMENT SYSTEM ',0,0);
$pdf->Cell(59	,5,'DONATION RECEIPT',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Times','',12);

$pdf->Cell(130	,5,'Jalan Hang Tuah Jaya,',0,0);
$pdf->Cell(59	,5,'',0,1);//end of line

$pdf->Cell(130	,5,'76100 Durian Tunggal,',0,0);
$pdf->Cell(59	,5,'',0,1);//end of line

$pdf->Cell(130	,5,'Melaka',0,0);
$pdf->Cell(25	,5,'',0,0);
$pdf->Cell(34	,5,'',0,1);//end of line

$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(25	,5,'',0,0);
$pdf->Cell(34	,5,'',0,1);//end of line
//make a dummy empty cell as a vertical spacer

$pdf->Line(10,30,200,30);

//billing address
$pdf->SetFont('Times','B',12);
$pdf->Cell(130	,5,'Invoice to:',0,0);
$pdf->Cell(100  ,5,'Billing Details:',0,1);//end of line

//add dummy cell at beginning of each line for indentation
$pdf->SetFont('Times','',12);

$pdf->Cell(130	,5,$invoice['name'] ,0,0);
$pdf->Cell(23	,5,'Ref No',0,0);
$pdf->Cell(34	,5, ''.$invoice['donateID'],0,1);
//end of the line

$pdf->Cell(130	,5,$invoice['contactNo'],0,0);
$pdf->Cell(59	,5,'',0,1);//end of line

$pdf->Cell(130	,5,$invoice['email'],0,0);
$pdf->Cell(25	,5,'Issued Date',0,0);
$pdf->Cell(34	,5,date('d-m-20y'),0,1);//end of line

if ($invoice['status'] == "active") {
    $pdf->Cell(130	,5,'',0,0);
    $pdf->Cell(25	,5,'Status',0,0);
    $pdf->Cell(34	,5,'Success',0,1);
}else{
    $pdf->Cell(130	,5,'',0,0);
    $pdf->Cell(25	,5,'Status',0,0);
    $pdf->Cell(34	,5,'Failed',0,1);
}


//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);//end of line

//invoice contents
$pdf->SetFont('Times','B',12);

$pdf->Cell(10	,5,'#',1,0);
$pdf->Cell(145	,5,'Description',1,0);
$pdf->Cell(34	,5,'Amount',1,1,'R');//end of line

$pdf->SetFont('Times','',12);

$query=mysqli_query($con,"SELECT * FROM donationcharity INNER JOIN fundrisercampaignn ON donationcharity.campaignID=fundrisercampaignn.campaignID WHERE  donateID = '".$invoice['donateID']."'");
$tax=0;
$amount=0;

while($item=mysqli_fetch_array($query)){
    $pdf->Cell(10	,5,'1',1,0);
	$pdf->Cell(145	,5,'Donation for '.$invoice['title'],1,0);
	$pdf->Cell(34	,5,'RM '.number_format($item['amountDonate']),1,1,'R');//end of line
	$tax+=$item['amountDonate'];
	$amount+=$item['amountDonate'];
}

//summary
$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(25	,5,'Total Amount',0,0);
$pdf->Cell(9	,5,'RM',1,0);
$pdf->Cell(25	,5,number_format($amount),1,1,'R');//end of line

$pdf->SetFont( 'Times', '', 11);
$pdf->Ln( 6 );
$pdf->Write( 6, "1. Should you require any further information, please feel free to contact our team.");
$pdf->Ln( 6 );
$pdf->Write( 6, "3. Please make all invoice payment to us by online banking or cash deposit.");
$pdf->SetFont( 'Times', 'I', 11 );
$pdf->Ln( 10 );
$pdf->Write( 6, "This is a computer generated invoice and signature is not required" );

$pdf->Output();
?>