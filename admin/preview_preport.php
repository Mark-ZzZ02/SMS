<?php
require('../config/dbcon.php');

function validate($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$month = isset($_GET['month']) ? validate($_GET['month']) : '';
$year = isset($_GET['year']) ? validate($_GET['year']) : '';
$case_status = isset($_GET['case_status']) ? validate($_GET['case_status']) : '';
$offense_type = isset($_GET['offense_type']) ? validate($_GET['offense_type']) : '';
$filename = isset($_GET['filename']) ? validate($_GET['filename']) : 'Monthly_Report';

$whereClauses = [];
if ($month) $whereClauses[] = "MONTH(date_added) = '$month'";
if ($year) $whereClauses[] = "YEAR(date_added) = '$year'";
if ($case_status) $whereClauses[] = "case_status='$case_status'";
if ($offense_type) $whereClauses[] = "offense_type='$offense_type'";

$whereSQL = count($whereClauses) > 0 ? 'WHERE ' . implode(' AND ', $whereClauses) : '';
$query = "SELECT * FROM categories $whereSQL ORDER BY id DESC";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Preview Report</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #ddeeff;
        }
        .export-btn {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<h2>Monthly Prefect Report - Preview</h2>

<table>
    <thead>
        <tr>
            <th>Surname</th>
            <th>First Name</th>
            <th>Program</th>
            <th>Section</th>
            <th>Major</th>
            <th>Year Level</th>
            <th>Date Added</th>
            <th>Case Status</th>
            <th>Offense Type</th>
            <th>Offense ID</th>
            <th>Sanction</th>
            <th>Completion Date</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['surname'] ?></td>
                <td><?= $row['first_name'] ?></td>
                <td><?= $row['program'] ?></td>
                <td><?= $row['section'] ?></td>
                <td><?= $row['major'] ?></td>
                <td><?= $row['year_level'] ?></td>
                <td><?= date('F j, Y', strtotime($row['date_added'])) ?></td>
                <td><?= $row['case_status'] ?></td>
                <td><?= $row['offense_type'] ?></td>
                <td><?= $row['offense_id'] ?></td>
                <td><?= $row['sanction'] ?></td>
                <td><?= $row['completion_date'] ? date('F j, Y', strtotime($row['completion_date'])) : 'N/A' ?></td>
            </tr>
        <?php } ?>
    </tbody>    
</table>

<form method="get" action="export_excel.php" class="export-btn">
    <!-- Pass same filters -->
    <input type="hidden" name="month" value="<?= $month ?>">
    <input type="hidden" name="year" value="<?= $year ?>">
    <input type="hidden" name="case_status" value="<?= $case_status ?>">
    <input type="hidden" name="offense_type" value="<?= $offense_type ?>">
    <input type="hidden" name="filename" value="<?= $filename ?>">
    <button type="submit">Export to Excel</button>
</form>

</body>
</html>
