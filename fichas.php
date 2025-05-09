<?php

require __DIR__ . '/vendor/autoload.php';

$pdf = new \FPDF('P', 'mm', 'A4');
$pdf->SetFont('Arial', 'B', 12);

$x_start = 10;
$y_start = 10;
$width = 45;   // ajustado
$height = 35;  // ajustado
$margin_x = 2; // ajustado
$margin_y = 2; // ajustado

$number = 1;

for ($page = 0; $number <= 1500; $page++) {
    $pdf->AddPage();
    for ($row = 0; $row < 7; $row++) {
        for ($col = 0; $col < 4; $col++) {
            if ($number > 1500) {
                break 2;
            }
            $x = $x_start + $col * ($width + $margin_x);
            $y = $y_start + $row * ($height + $margin_y);
            $pdf->Rect($x, $y, $width, $height);
            $pdf->SetXY($x, $y + $height / 2 - 5);
            $pdf->Cell($width, 10, utf8_decode('Ficha nº ' . str_pad($number, 4, '0', STR_PAD_LEFT)), 0, 0, 'C');
            $number++;
        }
    }
}

$pdf->Output('F', 'fichas.pdf');
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="fichas.pdf"');
readfile('fichas.pdf');