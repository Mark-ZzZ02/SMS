<?php
include('includes/header.php');
include('../middleware/adminMiddleware.php');
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 p-4 shadow rounded bg-light" style="background-image: linear-gradient( #ccffff, #e6ffe6, #ffffcc);">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>MONTHLY REPORTS</h4>
            </div>
            <div class="d-flex flex-wrap align-items-center mb-3">
                <form action="" method="GET" class="d-flex flex-wrap w-100">
                    <div class="mb-2 me-2">
                        <select name="month" class="form-select" style="min-width: 150px;" title="Select a specific month">
                            <option value="">Select Month</option>
                            <?php
                            for ($m = 1; $m <= 12; $m++) {
                                $selected = (isset($_GET['month']) && $_GET['month'] == $m) ? 'selected' : '';
                                echo "<option value='$m' $selected>" . date('F', mktime(0, 0, 0, $m, 1)) . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-2 me-2">
                        <select name="year" class="form-select" style="min-width: 150px;" title="Select a year">
                            <option value="">Select Year</option>
                            <?php
                            for ($y = date('Y'); $y >= 2000; $y--) {
                                $selected = (isset($_GET['year']) && $_GET['year'] == $y) ? 'selected' : '';
                                echo "<option value='$y' $selected>$y</option>";
                            }
                            ?>
                        </select>
                    </div>

                     <div class="mb-2 me-2">
                        <select name="case_status" class="form-select" style="min-width: 150px;" title="Select case status">
                            <option value="">Select case status</option>
                            <option value="Pending" <?= isset($_GET['case_status']) && $_GET['case_status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="Ongoing" <?= isset($_GET['case_status']) && $_GET['case_status'] === 'Ongoing' ? 'selected' : '' ?>>Ongoing</option>
                            <option value="Closed" <?= isset($_GET['case_status']) && $_GET['case_status'] === 'Closed' ? 'selected' : '' ?>>Closed</option>
                        </select>
                    </div>


                    <div class="mb-2 me-2">
                        <select name="offense_type" class="form-select" style="min-width: 150px;" title="Select offense type">
                            <option value="">Select Offense Type</option>
                            <option value="Minor" <?= isset($_GET['offense_type']) && $_GET['offense_type'] == 'Minor' ? 'selected' : '' ?>>Minor</option>
                            <option value="Major" <?= isset($_GET['offense_type']) && $_GET['offense_type'] == 'Major' ? 'selected' : '' ?>>Major</option>
                            <option value="Grave" <?= isset($_GET['offense_type']) && $_GET['offense_type'] == 'Grave' ? 'selected' : '' ?>>Grave</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </form>

                <button class="btn btn-info ms-2" onclick="openPrintWindow()">Print Report</button>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover mt-3">
                    <thead>
                        <tr>
                            <th class="text-center">STUDENT ID</th>
                            <th class="text-center">SURNAME</th>
                            <th class="text-center">FIRST NAME</th>
                            <th class="text-center">PROGRAM</th>
                            <th class="text-center">SECTION</th>
                            <th class="text-center">MAJOR</th>
                            <th class="text-center">YEAR LEVEL</th>
                            <th class="text-center">DATE</th>
                            <th class="text-center">CASE STATUS</th>
                            <th class="text-center">OFFENSE TYPE</th>
                            <th class="text-center">OFFENSE ID</th>
                            <th class="text-center">SANCTION</th>
                            <th class="text-center">COMPLETION DATE</th>
                        </tr>
                    </thead>
                    <tbody id="offenseTableBody">
                        <?php
                        include('../config/dbcon.php');

                        function validate($data) {
                            $data = trim($data);         
                            $data = stripslashes($data); 
                            $data = htmlspecialchars($data); 
                            return $data;
                        }

                        $whereClauses = [];
                        if (isset($_GET['month']) && $_GET['month'] != '') {
                            $month = validate($_GET['month']);
                            $whereClauses[] = "MONTH(date_added) = '$month'";
                        }
                        if (isset($_GET['year']) && $_GET['year'] != '') {
                            $year = validate($_GET['year']);
                            $whereClauses[] = "YEAR(date_added) = '$year'";
                        }
                        if (isset($_GET['case_status']) && $_GET['case_status'] != '') {
                            $case_status = validate($_GET['case_status']);
                            $whereClauses[] = "case_status='$case_status'";
                        }
                        if (isset($_GET['offense_type']) && $_GET['offense_type'] != '') {
                            $offense_type = validate($_GET['offense_type']);
                            $whereClauses[] = "offense_type='$offense_type'";
                        }

                        $whereSQL = count($whereClauses) > 0 ? 'WHERE ' . implode(' AND ', $whereClauses) : '';
                        $category = mysqli_query($con, "SELECT *, completion_date FROM categories $whereSQL ORDER BY id DESC");

                        if (mysqli_num_rows($category) > 0) {
                            foreach ($category as $item) {
                                $status = htmlspecialchars($item['case_status']);
                                $badgeClass = '';

                                        switch ($status) {
                                            case 'Pending':
                                                $badgeClass = 'badge bg-success';
                                                break;
                                            case 'Closed':
                                                $badgeClass = 'badge bg-danger';
                                                break;
                                            case 'Ongoing':
                                                $badgeClass = 'badge bg-warning text-dark';
                                                break;
                                            default:
                                                $badgeClass = 'badge bg-secondary'; 
                                                break;
                                        }
                                ?>
                                <tr>
                                    <td class="text-center"><?= htmlspecialchars($item['student_id']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['surname']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['first_name']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['program']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['section']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['major']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['year_level']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['date_added']); ?></td>
                                    <td class="text-center"><span class="<?= $badgeClass; ?>"><?= htmlspecialchars($item['case_status']); ?></span></td>
                                    <td class="text-center"><?= htmlspecialchars($item['offense_type']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['offense_id']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['sanction']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['completion_date']); ?></td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='14' class='text-center'>No records found</td></tr>"; 
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php');?>

<script>
    function openPrintWindow() {
        const params = new URLSearchParams({
            month: '<?= isset($_GET['month']) ? $_GET['month'] : '' ?>',
            year: '<?= isset($_GET['year']) ? $_GET['year'] : '' ?>',
            case_status: '<?= isset($_GET['case_status']) ? $_GET['case_status'] : '' ?>',
            offense_type: '<?= isset($_GET['offense_type']) ? $_GET['offense_type'] : '' ?>'
        }).toString();

        const printWindow = window.open('generate_pdf.php?' + params, '_blank', 'width=1000,height=700'); 
        printWindow.onload = function () {
            printWindow.print();
        };
    }
</script>
