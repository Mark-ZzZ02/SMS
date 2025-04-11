<?php 
include('includes/header.php'); 
include('../middleware/adminMiddleware.php');  
include('../config/dbcon.php');

$pendingQuery = "SELECT COUNT(*) as pending_count FROM categories WHERE case_status='Pending'";
$ongoingQuery = "SELECT COUNT(*) as ongoing_count FROM categories WHERE case_status='Ongoing'";
$closedQuery = "SELECT COUNT(*) as closed_count FROM categories WHERE case_status='Closed'";

$pendingResult = mysqli_query($con, $pendingQuery);
$ongoingResult = mysqli_query($con, $ongoingQuery);
$closedResult = mysqli_query($con, $closedQuery);

if ($pendingResult && $ongoingResult && $closedResult) {
    $pendingCount = mysqli_fetch_assoc($pendingResult)['pending_count'];
    $ongoingCount = mysqli_fetch_assoc($ongoingResult)['ongoing_count'];
    $closedCount = mysqli_fetch_assoc($closedResult)['closed_count'];
} else {
    echo "Error in queries: " . mysqli_error($con);
    exit;
}

$caseQuery = "SELECT * FROM categories";
$caseResults = mysqli_query($con, $caseQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="./css/stylesec.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <style>
        /* Add your custom styles here */
    </style>
</head>
<body>

<div class="home-content p-5" style="background-image: linear-gradient( #ccffff, #e6ffe6, #ffffcc); " >
    <div class="overview-boxes">
        <div class="box">
            <div class="right-side">
                <div class="box-topic">Total Cases</div>
                <h4 class="number"><?php echo mysqli_num_rows($caseResults); ?></h4>
                <div class="indicator">
                    <i class='bx bx-up-arrow-alt'></i>
                    <span class="text">Update</span>
                </div>
            </div>
            <a href="category.php" class="box-link">
                <i class='bx bx-cart-alt cart'></i>
            </a>
        </div>

        <div class="box">
            <div class="right-side">
                <div class="box-topic">Pending Cases</div>
                <h4 class="number"><?php echo $pendingCount ? $pendingCount : 0; ?></h4>
                <div class="indicator">
                    <i class='bx bx-up-arrow-alt'></i>
                    <span class="text">Update</span>
                </div>
            </div>
            <a href="category.php?status=pending" class="box-link">
                <i class='bx bxs-cart-add cart two'></i>
            </a>
        </div>

        <div class="box">
            <div class="right-side">
                <div class="box-topic">Ongoing Cases</div>
                <h4 class="number"><?php echo $ongoingCount ? $ongoingCount : 0; ?></h4>
                <div class="indicator">
                    <i class='bx bx-up-arrow-alt'></i>
                    <span class="text">Update</span>
                </div>
            </div>
            <a href="category.php?status=ongoing" class="box-link">
                <i class='bx bx-cart cart three'></i>
            </a>
        </div>

        <div class="box">
            <div class="right-side">
                <div class="box-topic">Closed Cases</div>
                <h4 class="number"><?php echo $closedCount ? $closedCount : 0; ?></h4>
                <div class="indicator">
                    <i class='bx bx-down-arrow-alt down'></i>
                    <span class="text">Update</span>
                </div>
            </div>
            <a href="category.php?status=closed" class="box-link">
                <i class='bx bxs-cart-download cart four'></i>
            </a>
        </div>
    </div>

    <div class="chart-container">
        <div class="chart-full">
            <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Case ID</th>
                        <th>Student Name</th>
                        <th>Parent Name</th>
                        <th>Case Status</th>
                        <th>Offense Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($caseResults)) {
                        echo '<tr>';
                        echo '<td>' . $row['case_id'] . '</td>';
                        echo '<td>' . $row['student_name'] . '</td>';
                        echo '<td>' . $row['parent_name'] . '</td>';
                        echo '<td>' . $row['case_status'] . '</td>';
                        echo '<td>' . $row['offense_type'] . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#example').DataTable();

        // Get URL parameters
        var urlParams = new URLSearchParams(window.location.search);
        var statusFilter = urlParams.get('status'); // Get the "status" parameter

        if (statusFilter) {
            // Apply the filter if the 'status' query parameter is present
            table.column(3).search(statusFilter, true, false).draw();  // Assuming the 3rd column (index 3) holds the case status
        }
    });
</script>

</body>
</html>
