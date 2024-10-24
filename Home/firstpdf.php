<?php

require('../fpdf/fpdf.php');  // Correctly include the FPDF library

$pdf = new FPDF();

$pdf->AddPage();

$pdf->Rect(5,5,200,287);
$pdf->SetFont('Arial', 'B', 16);

$pdf->Cell(40, 10, 'Hello World!');


$pdf->Output();

?>
