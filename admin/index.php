<?php 
include('includes/header.php'); 
include('../middleware/adminMiddleware.php');  

include('../config/dbcon.php');

$pendingQuery = "SELECT COUNT(*) as pending_count FROM categories WHERE case_status='Pending'";
$ongoingQuery = "SELECT COUNT(*) as ongoing_count FROM categories WHERE case_status='Ongoing'";
$closedQuery = "SELECT COUNT(*) as closed_count FROM categories WHERE case_status='Closed'";

$minorQuery = "SELECT COUNT(*) as minor_count FROM categories WHERE offense_type='Minor'";
$majorQuery = "SELECT COUNT(*) as major_count FROM categories WHERE offense_type='Major'";
$graveQuery = "SELECT COUNT(*) as grave_count FROM categories WHERE offense_type='Grave'";

$pendingResult = mysqli_query($con, $pendingQuery);
$ongoingResult = mysqli_query($con, $ongoingQuery);
$closedResult = mysqli_query($con, $closedQuery);

$minorResult = mysqli_query($con, $minorQuery);
$majorResult = mysqli_query($con, $majorQuery);
$graveResult = mysqli_query($con, $graveQuery);

if ($pendingResult && $ongoingResult && $closedResult && $minorResult && $majorResult && $graveResult) {
    $pendingCount = mysqli_fetch_assoc($pendingResult)['pending_count'];
    $ongoingCount = mysqli_fetch_assoc($ongoingResult)['ongoing_count'];
    $closedCount = mysqli_fetch_assoc($closedResult)['closed_count'];

    $minorCount = mysqli_fetch_assoc($minorResult)['minor_count'];
    $majorCount = mysqli_fetch_assoc($majorResult)['major_count'];
    $graveCount = mysqli_fetch_assoc($graveResult)['grave_count'];
} else {
    echo "Error in queries: " . mysqli_error($con);
    exit;
}

$monthlyCaseQuery = "SELECT 
                        MONTH(date_added) as month,
                        COUNT(*) as case_count 
                    FROM categories
                    WHERE YEAR(date_added) = YEAR(CURRENT_DATE)
                    GROUP BY MONTH(date_added)
                    ORDER BY month";

$monthlyCaseResult = mysqli_query($con, $monthlyCaseQuery);

$monthlyCounts = array_fill(0, 12, 0);

if ($monthlyCaseResult) {
    while ($row = mysqli_fetch_assoc($monthlyCaseResult)) {
        $monthIndex = $row['month'] - 1; 
        $monthlyCounts[$monthIndex] = $row['case_count'];
    }
} else {
    echo "Error in monthly case query: " . mysqli_error($con);
    exit;
}

$dailyCountsByMonth = [];

for ($m = 1; $m <= 12; $m++) {
    $query = "SELECT 
                DAY(date_added) as day,
                COUNT(*) as count 
              FROM categories
              WHERE MONTH(date_added) = $m AND YEAR(date_added) = YEAR(CURDATE())
              GROUP BY day
              ORDER BY day";

    $result = mysqli_query($con, $query);
    $dailyCounts = array_fill(1, 31, 0); // default values

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $day = (int)$row['day'];
            $dailyCounts[$day] = (int)$row['count'];
        }
    }

    $dailyCountsByMonth[$m - 1 ] = $dailyCounts;
}

$conferenceQuery = "SELECT date_meeting FROM categories WHERE date_meeting >= CURDATE() ORDER BY date_meeting ASC";
$conferenceResult = mysqli_query($con, $conferenceQuery);

if ($conferenceResult) {
    $conferences = [];
    while ($row = mysqli_fetch_assoc($conferenceResult)) {
        $conferences[] = $row;
    }
} else {
    echo "Error fetching conference schedules: " . mysqli_error($con);
    $conferences = [];
}

// Upcoming conference schedules
$conferenceQuery = "SELECT student_id, surname, first_name, parent_name, date_meeting, case_status 
                    FROM categories 
                    WHERE date_meeting >= CURDATE() 
                    ORDER BY date_meeting ASC";
$conferenceResult = mysqli_query($con, $conferenceQuery);
$conferences = [];
if ($conferenceResult) {
    while ($row = mysqli_fetch_assoc($conferenceResult)) {
        $conferences[] = $row;
    }
} else {
    echo "Error fetching conference schedules: " . mysqli_error($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="./css/stylesec.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .overview-boxes {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }
        .box {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #ccc;  
        }

        .number {
            font-size: 2rem;
            color: #333;  
        }

        .indicator {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
        }

        .indicator .bx {
            margin-right: 5px;
        }

    .pie-charts {
        display: flex;
        flex-direction: column;
        gap: 20px;
        flex: 1; 
    }

    .chart {
        height: 400px;
        background-color: none;
    }

    .conference-schedules-box {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border: 1px solid #ccc;
        height: 820px; 
        overflow-y: auto;
        flex: 0 0 48%; 
    }

    .conference-schedules-box ul li:hover {
        transform: scale(1.05);
        cursor: pointer;
    }

    .conference-schedules-box .box-topic {
        font-size: 1.2rem;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .schedule-list {
        list-style-type: none;
        padding: 0;
    }

    .schedule-list li {
        background-color: #f8f9fa;
        margin-bottom: 10px;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
        .chart-full {
            width: 100%;
            margin-top: 30px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
        }

        .minor-major-grave {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 30px;
        }

        .minor-box {
            background-color: #ff6666; 
        }

        .major-box {
            background-color:  #ffd540; 
        }

        .grave-box {
            background-color:  #0d6cf6; 
        }

        .box-topic, .text {
            font-size: 1.2rem;
            color: black; 
        }

        .number {
            font-size: 2rem;
            color:black; 
        }

        .indicator {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }

        .indicator .bx {
            margin-right: 5px;
        }
        
        .status-badge {
            display: inline-block;
            padding: 3px 6px;
            border-radius: 5px;
            font-size: 0.9rem;
            font-weight: bold;
            color: #fff;
        }

        .status-pending {
            background-color: #ff6666; /* orange */
        }

        .status-ongoing {
            background-color: #ffd540; /* blue */
            color: #333;
        }

        .status-closed {
            background-color: #0d6cf6; /* green */
        }

        .status-default {
            background-color: #777; /* fallback gray */
        }   

    </style>
</head>
<body>


    <div class="home-content p-5" style="background-image: linear-gradient( #ccffff, #e6ffe6, #ffffcc); " >
        <div class="overview-boxes">

            <div class="box">
                <div class="right-side">
                    <div class="box-topic">Total Cases</div>
                    <?php
                        $dash_category_query = "SELECT * from categories";
                        $dash_category_query_run = mysqli_query($con, $dash_category_query);
                        if ($category_total = mysqli_num_rows($dash_category_query_run)) {
                            echo '<h4 class="number">'.$category_total.'</h4>';
                        } else {
                            echo '<h4 class="number">0</h4>';
                        }
                    ?>
                    <div class="indicator">
                        <i class='bx bx-up-arrow-alt'></i>
                        <span class="text">Update</span>
                    </div>
                </div>
                <i class='bx bx-cart-alt cart'></i>
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
                <i class='bx bxs-cart-add cart two'></i>
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
                <i class='bx bx-cart cart three'></i>
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
                <i class='bx bxs-cart-download cart four'></i>
            </div>
        </div>

        <div class="minor-major-grave">
            <div class="box minor-box">
                <div class="box-topic">Minor Cases</div>
                <h4 class="number"><?php echo $minorCount ? $minorCount : 0; ?></h4>
            </div>

            <div class="box major-box">
                <div class="box-topic">Major Cases</div>
                <h4 class="number"><?php echo $majorCount ? $majorCount : 0; ?></h4>
            </div>

            <div class="box grave-box">
                <div class="box-topic">Grave Cases</div>
                <h4 class="number"><?php echo $graveCount ? $graveCount : 0; ?></h4>
            </div>
        </div>

        <div class="chart-container">
            <div class="pie-charts">
                <div class="chart">
                    <canvas id="caseStatusPieChart"></canvas>
                </div>

                <div class="chart">
                    <canvas id="offenseTypePieChart"></canvas>
                </div>
            </div>

            <div class="conference-schedules-box">
            <div class="box-topic">Conference Schedules</div>
            <ul class="schedule-list">
                <?php
                if (!empty($conferences)) {
                    foreach ($conferences as $conf) {
                        // Define CSS class based on case status
                        $statusClass = '';
                        switch (strtolower($conf['case_status'])) {
                            case 'pending':
                                $statusClass = 'status-pending';
                                break;
                            case 'ongoing':
                                $statusClass = 'status-ongoing';
                                break;
                            case 'closed':
                                $statusClass = 'status-closed';
                                break;
                            default:
                                $statusClass = 'status-default';
                        }

                        echo '<li>';
                        echo '<strong>' . date('F j, Y', strtotime($conf['date_meeting'])) . '</strong><br>';
                        echo 'Student: <strong>' . htmlspecialchars($conf['surname']) . ', ' . htmlspecialchars($conf['first_name']) . '</strong><br>';
                        echo 'Parent: ' . htmlspecialchars($conf['parent_name']) . '<br>';
                        echo 'Status: <span class="status-badge ' . $statusClass . '">' . htmlspecialchars($conf['case_status']) . '</span>';
                        echo '</li>';
                    }
                } else {
                    echo '<li>No upcoming conferences scheduled.</li>';
                }
                ?>
            </ul>
        </div>
        </div>

        <!-- <div class="chart-full">
            <canvas id="monthlyCasesChart"></canvas>
        </div> -->

        <!-- Filter Buttons -->
<div class="chart-full">
     <div class="btn-group mb-3" role="group" style="display: flex; flex-wrap: wrap; gap: 10px;">
        <button class="btn btn-outline-primary" onclick="filterMonth(null)">All</button>
        <?php
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        foreach ($months as $i => $monthName) {
            echo '<button class="btn btn-outline-primary" onclick="filterMonth('.$i.')">'.$monthName.'</button>';
        }
        ?>
    </div>
    <canvas id="monthlyCasesChart"></canvas>
</div>

    </div>

  <script>
    const caseStatusData = {
        labels: ['Pending', 'Ongoing', 'Closed'],
        datasets: [{
            data: [<?php echo $pendingCount; ?>, <?php echo $ongoingCount; ?>, <?php echo $closedCount; ?>],
            backgroundColor: ['#ff6666', '#ffd540', '#0d6cf6'],
            borderWidth: 1
        }]
    };
    const caseStatusConfig = {
        type: 'pie',
        data: caseStatusData,
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    enabled: true,
                    mode: 'nearest',
                    intersect: false,
                    callbacks: {
                        label: function (context) {
                            let label = context.label || '';
                            let value = context.raw || 0;
                            label += ': ' + value + ' cases';
                            return label;
                        }
                    }
                }
            },
            interaction: {
                mode: 'index',
                intersect: false
            }
        }
    };
    const caseStatusPieChart = new Chart(
        document.getElementById('caseStatusPieChart'),
        caseStatusConfig
    );

    const offenseTypeData = {
        labels: ['Minor', 'Major', 'Grave'],
        datasets: [{
            data: [<?php echo $minorCount; ?>, <?php echo $majorCount; ?>, <?php echo $graveCount; ?>],
            backgroundColor: ['#ff6666', '#ffd540', '#0d6cf6'],
            borderWidth: 1
        }]
    };
    const offenseTypeConfig = {
        type: 'pie',
        data: offenseTypeData,
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    enabled: true,
                    mode: 'nearest',
                    intersect: false,
                    callbacks: {
                        label: function (context) {
                            let label = context.label || '';
                            let value = context.raw || 0;
                            label += ': ' + value + ' cases';
                            return label;
                        }
                    }
                }
            },
            interaction: {
                mode: 'index',
                intersect: false
            }
        }
    };
    const offenseTypePieChart = new Chart(
        document.getElementById('offenseTypePieChart'),
        offenseTypeConfig
    );

    const monthNames = [
        'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
        'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
    ];

    const allMonthlyData = <?php echo json_encode($monthlyCounts); ?>;
    const dailyDataByMonth = <?php echo json_encode($dailyCountsByMonth); ?>;

    const ctx = document.getElementById('monthlyCasesChart').getContext('2d');

    const monthlyCasesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: monthNames,
            datasets: [{
                label: 'Cases',
                data: allMonthlyData,
                backgroundColor: '#17a2b8',
                borderColor: '#17a2b8',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Monthly Cases for <?php echo date("Y"); ?>',
                    font: {
                        size: 18
                    }
                },
                tooltip: {
                    enabled: true,
                    mode: 'index',
                    intersect: false
                }
                },
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Months'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Cases'
                        }
                    }
                }
            }

    });

    function filterMonth(monthIndex) {
        if (monthIndex === null) {
            // Reset to monthly view
            monthlyCasesChart.data.labels = monthNames;
            monthlyCasesChart.data.datasets[0].label = 'Monthly Cases';
            monthlyCasesChart.data.datasets[0].data = allMonthlyData;
            monthlyCasesChart.options.plugins.title.text = 'Monthly Cases for <?php echo date("Y"); ?>';
            monthlyCasesChart.options.scales.x.title.text = 'Month';
        } else {
            // Show daily view for selected month
            const dailyData = dailyDataByMonth[monthIndex];
            const days = Object.keys(dailyData).map(d => parseInt(d));
            const values = Object.values(dailyData);

            monthlyCasesChart.data.labels = days;
            monthlyCasesChart.data.datasets[0].label = `${monthNames[monthIndex]} Daily Cases`;
            monthlyCasesChart.data.datasets[0].data = values;
            monthlyCasesChart.options.plugins.title.text = `Daily Cases for ${monthNames[monthIndex]} <?php echo date("Y"); ?>`;
            monthlyCasesChart.options.scales.x.title.text = 'Day';
        }

        monthlyCasesChart.update();
    }

    </script>

</body>
</html>
