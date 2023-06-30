<?php
require('fpdf/fpdf.php');

$pdf=new FPDF();
// $pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
$pdf->AddPage();
// $pdf->Image( $logoFile, $logoXPos, $logoYPos, $logoWidth );
$pdf->SetFont('Arial','B',16);
$con = mysqli_connect("localhost","root","","library");
$sql = "SELECT * from tblpatrons where FullName='{$_POST["patronid"]}'";
$result = mysqli_query($con, $sql);
while($rows= mysqli_fetch_array($result)){
    $pdf->Cell(40,10,$rows["PatronId"]);
}


$pdf->Output();
?>