<?php
require('../tcpdf/fpdf.php');

function validate($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$month = isset($_GET['month']) ? validate($_GET['month']) : '';
$year = isset($_GET['year']) ? validate($_GET['year']) : '';
$case_status = isset($_GET['case_status']) ? validate($_GET['case_status']) : '';
$offense_type = isset($_GET['offense_type']) ? validate($_GET['offense_type']) : '';
$filename = isset($_GET['filename']) ? validate($_GET['filename']) : 'Monthly_Report';

include('../config/dbcon.php'); 

$whereClauses = [];
if ($month) $whereClauses[] = "MONTH(date_added) = '$month'";
if ($year) $whereClauses[] = "YEAR(date_added) = '$year'";
if ($case_status) $whereClauses[] = "case_status='$case_status'";
if ($offense_type) $whereClauses[] = "offense_type='$offense_type'";

$whereSQL = count($whereClauses) > 0 ? 'WHERE ' . implode(' AND ', $whereClauses) : '';
$query = "SELECT * FROM categories $whereSQL ORDER BY id DESC";
$result = mysqli_query($con, $query);

// Create PDF
$pdf = new FPDF('L', 'mm', 'A4'); 
$pdf->SetTitle('Monthly Prefect Report');

// Function to add consistent header
function addHeader($pdf, $pageTitle) {
    $pdf->AddPage();
    $pdf->Image('./css/pref.png', 10, 10, 25);
    $pdf->SetFont('Arial', 'B', 18);
    $pdf->Cell(0, 10, 'Bestlink College of the Philippines', 0, 1, 'C');
    $pdf->SetFont('Arial', 'I', 12);
    $pdf->Cell(0, 8, 'Office of the Prefect of Discipline', 0, 1, 'C');
    $pdf->Ln(5);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, $pageTitle, 0, 1, 'C');
    $pdf->Ln(5);
}

// Page 1 - Student Info
addHeader($pdf, 'Monthly Report - Student Information');
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(220, 230, 255);
$pdf->Cell(60, 10, 'SURNAME', 1, 0, 'C', true);
$pdf->Cell(80, 10, 'FIRST NAME', 1, 0, 'C', true);
$pdf->Cell(60, 10, 'PROGRAM', 1, 0, 'C', true);
$pdf->Cell(60, 10, 'SECTION', 1, 1, 'C', true);

$pdf->SetFont('Arial', '', 10);
while ($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(60, 10, $row['surname'], 1);
    $pdf->Cell(80, 10, $row['first_name'], 1);
    $pdf->Cell(60, 10, $row['program'], 1);
    $pdf->Cell(60, 10, $row['section'], 1);
    $pdf->Ln();
}

// Page 2 - Academic Info
mysqli_data_seek($result, 0);
addHeader($pdf, 'Monthly Report - Academic Details');
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(220, 230, 255);
$pdf->Cell(60, 10, 'MAJOR', 1, 0, 'C', true);
$pdf->Cell(60, 10, 'YEAR LEVEL', 1, 0, 'C', true);
$pdf->Cell(80, 10, 'DATE', 1, 0, 'C', true);
$pdf->Cell(60, 10, 'CASE STATUS', 1, 1, 'C', true);

$pdf->SetFont('Arial', '', 10);
while ($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(60, 10, $row['major'], 1);
    $pdf->Cell(60, 10, $row['year_level'], 1);
    $pdf->Cell(80, 10, date('F j, Y', strtotime($row['date_added'])), 1);
    $pdf->Cell(60, 10, $row['case_status'], 1);
    $pdf->Ln();
}

// Page 3 - Offense Info
mysqli_data_seek($result, 0);
addHeader($pdf, 'Monthly Report - Offense Records');
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(220, 230, 255);
$pdf->Cell(60, 10, 'OFFENSE TYPE', 1, 0, 'C', true);
$pdf->Cell(60, 10, 'OFFENSE ID', 1, 0, 'C', true);
$pdf->Cell(80, 10, 'SANCTION', 1, 0, 'C', true);
$pdf->Cell(60, 10, 'COMPLETION DATE', 1, 1, 'C', true);

$pdf->SetFont('Arial', '', 10);
while ($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(60, 10, $row['offense_type'], 1);
    $pdf->Cell(60, 10, $row['offense_id'], 1);
    $pdf->Cell(80, 10, $row['sanction'], 1);
    $pdf->Cell(60, 10, $row['completion_date'] ? date('F j, Y', strtotime($row['completion_date'])) : 'N/A', 1);
    $pdf->Ln();
}

// Output
$pdf->Output('I', $filename . '.pdf');
?>
