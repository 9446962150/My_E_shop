<?php
	require('./fpdf/fpdf.php');
	$pdf = new FPDF('P', 'mm', "A4");
	session_start();
	include("db.php");
    $user = $_SESSION['user'];
    $invno = $_GET['no'];
    $sql = "SELECT * FROM orders WHERE invoice_no='$invno'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $sql = "SELECT * FROM payment WHERE invoice_no='$invno'";
    $ans = mysqli_query($conn, $sql);
    $ret = mysqli_fetch_array($ans);
	$pdf->AddPage();
	$pdf->SetFont('Arial', 'B', 20);
	$pdf->Cell(71,10,'',0,0);
	$pdf->Cell(59,5, 'Invoice',0,0);
	$pdf->Cell(59,5, '',0,1);
	$pdf->Cell(59,10,'',0,1);
	$pdf->SetFont('Arial', 'B',10);
	$pdf->Cell(71 ,5, 'Billing Address:',0,0);
	$pdf->Cell(59,5,'',0,0);
	$pdf->Cell(59,5, '',0,1);
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(130,5,'Name : '.$row['Name'],0,0);
	$pdf->Cell(25,5, 'Invoice Date:',0,0);
	$pdf->Cell(34,5,$ret['pay_date'],0,1);
	$pdf->Cell(130,5,'Address : '.$row['Address'],0,0);
	$pdf->Cell(25,5, 'Invoice No: ',0,0);
	$pdf->Cell(34,5,$invno,0,1);
	$pdf->Cell(130 ,5,'Phone no: '.$row['Contact'],0,0);
	$pdf->Cell(25,5, '',0,0);
	$pdf->Cell(34,5, '',0,1);
	$pdf->Cell(130 ,5,'',0,0);
	$pdf->Cell(25,5, '',0,0);
	$pdf->Cell(34,5, '',0,1);

	$pdf->SetFont('Arial', 'B', 10);
	$pdf->Cell(130 ,5, 'Sold by : Your E-commerce Store',0,1);
	$pdf->Cell(130 ,5, 'Main Street Erattupetta, Kottayam District , Kerala , India',0,1);
	$pdf->Cell(130 ,5, 'Contact: support@yourstore.com | Phone: +91 9600033221',0,1);
	$pdf->Cell(59,5,'',0,0);
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->Cell(189,10,'',0,1);


	$pdf->SetFont('Arial', 'B', 10);
	//heading of table 
	$pdf->Cell(10,6,'SI',1,0,'C');
	$pdf->Cell(80,6,'Description',1,0,'C');
	$pdf->Cell(23,6,'Qty',1,0,'C');
	$pdf->Cell(30,6,'Unit Price ',1,0,'C');
	$pdf->Cell(25,6,'Total',1,1,'C');
	/*Heading of the table end*/
	
	$pdf->SetFont('Arial','',10);
	$i=0;
    $sql = "SELECT * FROM orders WHERE invoice_no='$invno'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
    	$i++;
    	$id = $row['id'];
    	$query = "SELECT * FROM products WHERE id = '$id'";
        $product_result = mysqli_query($conn, $query);
        $product = mysqli_fetch_array($product_result);
		$pdf->Cell (10,6,$i,1,0);
		$pdf->Cell(80,6, $product['name'],1,0);
		$pdf->Cell(23,6,$row['qty'],1,0, 'R');
		$pdf->Cell(30 ,6, $product['price'],1,0, 'R');
		$pdf->Cell(25 ,6, $row['Amount'],1,1, 'R');
	}
	$pdf->Cell(118,6,'',0,0);
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->Cell(25,6, 'Grant Total',0,0);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(25,6, $ret['Amount'],1,1, 'R');
	$pdf->Cell(189,10,'',0,1);
	$pdf->Cell(189,10,'',0,1);
	$pdf->Cell(118,6,'',0,0);
	$pdf->Cell(25,6, 'Rs. '.$ret['Amount'].' Paid Successfully.',0,1);
	$pdf->Cell(118,6,'',0,0);
	$pdf->Cell(25,6, 'Authorized Signatory ',0,1);

	$pdf->Output();
?>