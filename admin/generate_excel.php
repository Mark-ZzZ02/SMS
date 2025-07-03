<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Chart\{
    Chart, Legend, PlotArea, DataSeries, DataSeriesValues, Title
};

function validate($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// GET parameters
$month        = isset($_GET['month']) ? validate($_GET['month']) : '';
$year         = isset($_GET['year']) ? validate($_GET['year']) : '';
$case_status  = isset($_GET['case_status']) ? validate($_GET['case_status']) : '';
$offense_type = isset($_GET['offense_type']) ? validate($_GET['offense_type']) : '';
$filename     = isset($_GET['filename']) && $_GET['filename'] !== '' ? validate($_GET['filename']) : 'Monthly_Report';

include('../config/dbcon.php');

// Build WHERE clause
$where = [];
if ($month)        $where[] = "MONTH(date_added) = '$month'";
if ($year)         $where[] = "YEAR(date_added) = '$year'";
if ($case_status)  $where[] = "case_status = '$case_status'";
if ($offense_type) $where[] = "offense_type = '$offense_type'";
$whereSQL = $where ? 'WHERE ' . implode(' AND ', $where) : '';

// Fetch data
$query = "SELECT * FROM categories $whereSQL ORDER BY date_added ASC";
$result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_error($con));

// Count aggregates
$dailyCounts = [];
$statusCounts = ['Pending' => 0, 'Ongoing' => 0, 'Done' => 0];
$typeCounts = ['Minor' => 0, 'Major' => 0, 'Grave' => 0];

while ($row = mysqli_fetch_assoc($result)) {
    $day = date('j', strtotime($row['date_added']));
    $dailyCounts[$day] = ($dailyCounts[$day] ?? 0) + 1;

    $status = ucfirst(strtolower($row['case_status']));
    if (isset($statusCounts[$status])) $statusCounts[$status]++;

    $type = ucfirst(strtolower($row['offense_type']));
    if (isset($typeCounts[$type])) $typeCounts[$type]++;
}
ksort($dailyCounts);
mysqli_data_seek($result, 0);

// Setup spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Monthly Report');

// Header info
$sheet->setCellValue('A1', 'Filter Summary:')
      ->setCellValue('B1', "Month=" . ($month ?: 'All') . "; Year=" . ($year ?: 'All') . 
                            "; Status=" . ($case_status ?: 'All') . "; Type=" . ($offense_type ?: 'All'));
$sheet->getStyle('A1:B1')->getFont()->setBold(true);

// Column headers
$headers = ['STUDENT ID','SURNAME','FIRST NAME','PROGRAM','SECTION','MAJOR','YEAR LEVEL','DATE ADDED',
            'CASE STATUS','OFFENSE TYPE','OFFENSE ID','SANCTION','COMPLETION DATE'];
$startRow = 3;
foreach ($headers as $i => $hdr) {
    $col = chr(65 + $i);
    $sheet->setCellValue("$col$startRow", $hdr);
    $sheet->getStyle("$col$startRow")->getFont()->setBold(true);
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Data rows
$rowNum = $startRow + 1;
while ($row = mysqli_fetch_assoc($result)) {
    $sheet->setCellValue("A$rowNum", $row['student_id']);
    $sheet->setCellValue("B$rowNum", $row['surname']);
    $sheet->setCellValue("C$rowNum", $row['first_name']);
    $sheet->setCellValue("D$rowNum", $row['program']);
    $sheet->setCellValue("E$rowNum", $row['section']);
    $sheet->setCellValue("F$rowNum", $row['major']);
    $sheet->setCellValue("G$rowNum", $row['year_level']);
    $sheet->setCellValue("H$rowNum", date('F j, Y', strtotime($row['date_added'])));
    $sheet->setCellValue("I$rowNum", $row['case_status']);
    $sheet->setCellValue("J$rowNum", $row['offense_type']);
    $sheet->setCellValue("K$rowNum", $row['offense_id']);
    $sheet->setCellValue("L$rowNum", $row['sanction']);
    $sheet->setCellValue("M$rowNum", $row['completion_date'] 
        ? date('F j, Y', strtotime($row['completion_date'])) : 'N/A');
    $rowNum++;
}

// Calculate last data row number
$lastDataRow = $rowNum - 1;

// Create a new worksheet for charts
$chartSheet = $spreadsheet->createSheet();
$chartSheet->setTitle('Charts');

// Helper function to convert number to Excel column letter
function colLetter($num) {
    $div = $num;
    $col = '';
    while ($div > 0) {
        $mod = ($div - 1) % 26;
        $col = chr(65 + $mod) . $col;
        $div = intval(($div - $mod) / 26);
    }
    return $col;
}

// Prepare chart data on the chart sheet starting at A1
$chartStartRow = 2;  // Leave a blank row for title

// Set a big title for the charts page
$chartSheet->setCellValue("A1", "Monthly Report Charts");
$chartSheet->getStyle("A1")->getFont()->setBold(true)->setSize(16);

// Style headers for chart data (hidden columns will hold chart data)
$chartSheet->setCellValue("A{$chartStartRow}", 'Day');
$chartSheet->setCellValue("B{$chartStartRow}", 'Cases');
$chartSheet->setCellValue("D{$chartStartRow}", 'Status');
$chartSheet->setCellValue("E{$chartStartRow}", 'Count');
$chartSheet->setCellValue("G{$chartStartRow}", 'Type');
$chartSheet->setCellValue("H{$chartStartRow}", 'Count');

$chartSheet->getStyle("A{$chartStartRow}:B{$chartStartRow}")->getFont()->setBold(true);
$chartSheet->getStyle("D{$chartStartRow}:E{$chartStartRow}")->getFont()->setBold(true);
$chartSheet->getStyle("G{$chartStartRow}:H{$chartStartRow}")->getFont()->setBold(true);

$r = $chartStartRow + 1;
foreach ($dailyCounts as $day => $count) {
    $chartSheet->setCellValue("A{$r}", $day);
    $chartSheet->setCellValue("B{$r}", $count);
    $r++;
}
$dailyCountRows = $r - 1;

$r = $chartStartRow + 1;
foreach ($statusCounts as $k => $v) {
    $chartSheet->setCellValue("D{$r}", $k);
    $chartSheet->setCellValue("E{$r}", $v);
    $r++;
}
$statusCountRows = $r - 1;

$r = $chartStartRow + 1;
foreach ($typeCounts as $k => $v) {
    $chartSheet->setCellValue("G{$r}", $k);
    $chartSheet->setCellValue("H{$r}", $v);
    $r++;
}
$typeCountRows = $r - 1;

// Add section titles for charts on the sheet
$chartSheet->setCellValue('A1', 'Monthly Report Charts')->getStyle('A1')->getFont()->setBold(true)->setSize(18);
$chartSheet->setCellValue('A21', 'Cases per Day')->getStyle('A21')->getFont()->setBold(true)->setSize(14);
$chartSheet->setCellValue('A40', 'Case Status Distribution')->getStyle('A40')->getFont()->setBold(true)->setSize(14);
$chartSheet->setCellValue('I40', 'Offense Types Distribution')->getStyle('I40')->getFont()->setBold(true)->setSize(14);

// Define data series for bar chart (Cases per Day)
$barDataSeriesLabels = [
    new DataSeriesValues('String', "'{$chartSheet->getTitle()}'!\$B\${$chartStartRow}", null, 1),
];
$barXValues = [
    new DataSeriesValues('String', "'{$chartSheet->getTitle()}'!\$A\$" . ($chartStartRow + 1) . ":\$A\${$dailyCountRows}", null, $dailyCountRows - $chartStartRow),
];
$barYValues = [
    new DataSeriesValues('Number', "'{$chartSheet->getTitle()}'!\$B\$" . ($chartStartRow + 1) . ":\$B\${$dailyCountRows}", null, $dailyCountRows - $chartStartRow),
];

$barSeries = new DataSeries(
    DataSeries::TYPE_BARCHART,
    DataSeries::GROUPING_CLUSTERED,
    range(0, count($barYValues) - 1),
    $barDataSeriesLabels,
    $barXValues,
    $barYValues
);
$barSeries->setPlotDirection(DataSeries::DIRECTION_COL);

$barPlotArea = new PlotArea(null, [$barSeries]);
$barLegend = new Legend(Legend::POSITION_RIGHT);
$barTitle = new Title('Cases per Day');

$barChart = new Chart(
    'DailyCases',
    $barTitle,
    $barLegend,
    $barPlotArea
);

// Position the bar chart below its title
$barChart->setTopLeftPosition("A22");
$barChart->setBottomRightPosition("P38"); // Wide chart covering 16 columns (A to P)

// Pie chart for Case Status
$startRowPlusOne = $chartStartRow + 1;

$statusLabels = [
    new DataSeriesValues('String', "'{$chartSheet->getTitle()}'!\$D\$" . $startRowPlusOne . ":\$D\${$statusCountRows}", null, $statusCountRows - $chartStartRow),
];
$statusValues = [
    new DataSeriesValues('Number', "'{$chartSheet->getTitle()}'!\$E\$" . $startRowPlusOne . ":\$E\${$statusCountRows}", null, $statusCountRows - $chartStartRow),
];

$statusSeries = new DataSeries(
    DataSeries::TYPE_PIECHART,
    null,
    range(0, count($statusValues) - 1),
    [],
    $statusLabels,
    $statusValues
);

$statusPlotArea = new PlotArea(null, [$statusSeries]);
$statusTitle = new Title('Case Status Distribution');

$statusChart = new Chart(
    'StatusPie',
    $statusTitle,
    null,
    $statusPlotArea
);

// Pie chart for Offense Types
$typeLabels = [
    new DataSeriesValues('String', "'{$chartSheet->getTitle()}'!\$G\$" . $startRowPlusOne . ":\$G\${$typeCountRows}", null, $typeCountRows - $chartStartRow),
];
$typeValues = [
    new DataSeriesValues('Number', "'{$chartSheet->getTitle()}'!\$H\$" . $startRowPlusOne . ":\$H\${$typeCountRows}", null, $typeCountRows - $chartStartRow),
];

$typeSeries = new DataSeries(
    DataSeries::TYPE_PIECHART,
    null,
    range(0, count($typeValues) - 1),
    [],
    $typeLabels,
    $typeValues
);

$typePlotArea = new PlotArea(null, [$typeSeries]);
$typeTitle = new Title('Offense Types Distribution');

$typeChart = new Chart(
    'TypePie',
    $typeTitle,
    null,
    $typePlotArea
);

// Position the two pie charts side-by-side below their titles, with a gap between
$statusChart->setTopLeftPosition("A41");
$statusChart->setBottomRightPosition("H58");

$typeChart->setTopLeftPosition("I41");
$typeChart->setBottomRightPosition("P58");

$chartSheet->addChart($barChart);
$chartSheet->addChart($statusChart);
$chartSheet->addChart($typeChart);


// Output Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment;filename=\"{$filename}.xlsx\"");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->setIncludeCharts(true);
$writer->save('php://output');
exit();
?>
