<?php
function generate_pdf($order, $car)
{
    require_once('includes/fpdf181/fpdf.php');

    $pdf = new FPDF('P', 'mm', 'A4');
    $pdf->AddPage();
    $pdf->Image('includes/temp_images/szerzodes_old1.jpg', 0, 0, 210, 297);
    $pdf->SetFont('Arial', '', 10);

    $pdf->SetXY(17, 72);
    $pdf->Cell(86, 6, iconv('UTF-8', 'ISO-8859-2', $order['firstname']));

    $pdf->SetXY(108, 72);
    $pdf->Cell(86, 6, iconv('UTF-8', 'ISO-8859-2', $order['lastname']));

    $pdf->SetXY(17, 87.5);
    $pdf->Cell(86, 6, iconv('UTF-8', 'ISO-8859-2', $order['birthdate']));

    $pdf->SetXY(108, 87.5);
    $pdf->Cell(86, 6, iconv('UTF-8', 'ISO-8859-2', $order['email']));

    $pdf->SetXY(17, 102.2);
    $pdf->Cell(86, 6, iconv('UTF-8', 'ISO-8859-2', $order['address']));

    $pdf->SetXY(108, 102.2);
    $pdf->Cell(86, 6, iconv('UTF-8', 'ISO-8859-2', $order['phone']));

    $pdf->SetXY(17, 125.0);
    $pdf->Cell(86, 6, iconv('UTF-8', 'ISO-8859-2', $car['modell']));

    $pdf->SetXY(108, 125.0);
    $pdf->Cell(86, 6, iconv('UTF-8', 'ISO-8859-2', $car['type']));

    $pdf->SetXY(17, 125.0);
    $pdf->Cell(86, 6, iconv('UTF-8', 'ISO-8859-2', $car['modell']));

    $pdf->SetXY(108, 125.0);
    $pdf->Cell(86, 6, iconv('UTF-8', 'ISO-8859-2', $car['type']));

    $pdf->SetXY(17, 140.0);
    $pdf->Cell(86, 6, iconv('UTF-8', 'ISO-8859-2', $car['factory_id']));

    $pdf->SetXY(108, 140.0);
    $pdf->Cell(86, 6, iconv('UTF-8', 'ISO-8859-2', $car['born_date']));

    $pdf->SetXY(82, 163.0);
    $pdf->Cell(86, 6, date('Y. M. d. h:i', strtotime($order['start_date'])) . ' - ' . date('Y. M. d. h:i', strtotime($order['end_date'])));

    $pdf->SetXY(17, 178.0);
    $pdf->Cell(86, 6, iconv('UTF-8', 'ISO-8859-2', $order['rent_total'] . ' HUF'));

    $pdf->SetXY(108, 178.0);
    $pdf->Cell(86, 6, iconv('UTF-8', 'ISO-8859-2', $order['deposit'] . ' HUF'));

    $pdf->AddPage();
    $pdf->Image('includes/temp_images/szerzodes_old2.jpg', 0, 0, 210, 297);

    $pdf->SetXY(17, 61.5);
    $pdf->Cell(86, 6, iconv('UTF-8', 'ISO-8859-2', $car['modell']));

    $pdf->SetXY(108, 61.5);
    $pdf->Cell(86, 6, iconv('UTF-8', 'ISO-8859-2', $car['type']));

    $pdf->SetXY(17, 76.8);
    $pdf->Cell(86, 6, iconv('UTF-8', 'ISO-8859-2', $car['born_date']));

    $pdf->SetXY(108, 76.8);
    $pdf->Cell(86, 6, iconv('UTF-8', 'ISO-8859-2', $car['color']));

    $pdf->SetXY(154, 76.8);
    $pdf->Cell(86, 6, iconv('UTF-8', 'ISO-8859-2', $car['doors_number']));

    $pdf->SetXY(17, 91.5);
    $pdf->Cell(86, 6, iconv('UTF-8', 'ISO-8859-2', $car['persons']));

    $pdf->SetXY(108, 91.5);
    $pdf->Cell(86, 6, iconv('UTF-8', 'ISO-8859-2', $car['insurance_name']));

    $pdf->SetXY(17, 107.0);
    $pdf->Cell(86, 6, iconv('UTF-8', 'ISO-8859-2', $car['insurance_until_date']));

    $pdf->SetXY(108, 107.0);
    $pdf->Cell(86, 6, iconv('UTF-8', 'ISO-8859-2', $car['insurance_id']));

    $pdf->SetXY(77, 126.0);
    $pdf->Cell(58, 6, iconv('UTF-8', 'ISO-8859-2', $order['starting_km']), 0, 0, 'C');

    $pdf->SetXY(137, 126.0);
    $pdf->Cell(58, 6, iconv('UTF-8', 'ISO-8859-2', $order['last_km']), 0, 0, 'C');

    $pdf->SetXY(77, 134.5);
    $pdf->MultiCell(56, 6, iconv('UTF-8', 'ISO-8859-2', $car['car_status_details']), 0, 'C', false);

    $pdf->SetXY(137, 134.5);
    $pdf->MultiCell(56, 6, iconv('UTF-8', 'ISO-8859-2', $order['accident_details']), 0, 'C', false);

    $pdf->SetXY(17, 248.5);
    $pdf->Cell(58, 6, iconv('UTF-8', 'ISO-8859-2', $order['fixing_price'] . ' HUF'), 0, 0, 'L');

    $filename = sprintf('berleti_szerzodes_ON%05d.pdf', $order['rent_id']);
    return $pdf->Output('D', $filename);
}
?>



