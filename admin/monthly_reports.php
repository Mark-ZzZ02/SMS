<?php 

include('includes/header.php');
include('../middleware/adminMiddleware.php');

?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 p-4 shadow rounded bg-light">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>MONTHLY REPORTS</h4>
            </div>
            <div class="d-flex align-items-center mb-3">
                <form action="" method="GET" class="d-flex">
                    <select name="month" class="form-select me-2" style="min-width: 120px;">
                        <option value="">Select Month</option>
                        <?php
                        // Generate month options
                        for ($m = 1; $m <= 12; $m++) {
                            $selected = (isset($_GET['month']) && $_GET['month'] == $m) ? 'selected' : '';
                            echo "<option value='$m' $selected>" . date('F', mktime(0, 0, 0, $m, 1)) . "</option>";
                        }
                        ?>
                    </select>
                    <select name="year" class="form-select me-2" style="min-width: 120px;">
                        <option value="">Select Year</option>
                        <?php
                        // Generate year options (you can adjust the range as needed)
                        for ($y = date('Y'); $y >= 2000; $y--) {
                            $selected = (isset($_GET['year']) && $_GET['year'] == $y) ? 'selected' : '';
                            echo "<option value='$y' $selected>$y</option>";
                        }
                        ?>
                    </select>
                    <select name="completion_status" class="form-select me-2" style="min-width: 200px;">
                        <option value="">Select Status</option>
                        <option value="Open" <?= isset($_GET['completion_status']) && $_GET['completion_status'] == 'Open' ? 'selected' : '' ?>>Open</option>
                        <option value="Under_investigation" <?= isset($_GET['completion_status']) && $_GET['completion_status'] == 'Under_investigation' ? 'selected' : '' ?>>Under Investigation</option>
                        <option value="Closed" <?= isset($_GET['completion_status']) && $_GET['completion_status'] == 'Closed' ? 'selected' : '' ?>>Closed</option>
                    </select>
                    <select name="offense_type" class="form-select me-2" style="min-width: 200px;">
                        <option value="">Select Offense Type</option>
                        <option value="Minor" <?= isset($_GET['offense_type']) && $_GET['offense_type'] == 'Minor' ? 'selected' : '' ?>>Minor</option>
                        <option value="Major" <?= isset($_GET['offense_type']) && $_GET['offense_type'] == 'Major' ? 'selected' : '' ?>>Major</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover mt-3">
                    <thead>
                        <tr>
                            <th class="text-center">STUDENT NUMBER</th>
                            <th class="text-center">NAME</th>
                            <th class="text-center">OFFENSE</th>
                            <th class="text-center">OFFENSE TYPE</th>
                            <th class="text-center">CASE ID</th>
                            <th class="text-center">DATE ADDED</th>
                            <th class="text-center">INVESTIGATION</th>
                            <th class="text-center">STATUS</th>
                            <th class="text-center">STAFF</th>
                            <th class="text-center">PUNISHMENT</th>
                            <th class="text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody id="offenseTableBody">
                        <?php
                        // Ensure you have a valid database connection $con
                        $whereClauses = [];
                        if (isset($_GET['month']) && $_GET['month'] != '') {
                            $month = validate($_GET['month']);
                            $whereClauses[] = "MONTH(date_added) = '$month'";
                        }
                        if (isset($_GET['year']) && $_GET['year'] != '') {
                            $year = validate($_GET['year']);
                            $whereClauses[] = "YEAR(date_added) = '$year'";
                        }
                        if (isset($_GET['completion_status']) && $_GET['completion_status'] != '') {
                            $completion_status = validate($_GET['completion_status']);
                            $whereClauses[] = "completion_status='$completion_status'";
                        }
                        if (isset($_GET['offense_type']) && $_GET['offense_type'] != '') {
                            $offense_type = validate($_GET['offense_type']);
                            $whereClauses[] = "offense_type='$offense_type'";
                        }

                        $whereSQL = count($whereClauses) > 0 ? 'WHERE ' . implode(' AND ', $whereClauses) : '';
                        $category = mysqli_query($con, "SELECT * FROM categories $whereSQL ORDER BY id DESC");

                        if (mysqli_num_rows($category) > 0) {
                            foreach ($category as $item) {
                                ?>
                                <tr>
                                    <td class="text-center"><?= htmlspecialchars($item['student_id']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['name']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['offense_id']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['offense_type']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['case_id']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['date_added']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['investigation_notes']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['completion_status']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['assigned_staff']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['punishment_type']); ?></td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li>
                                                    <a class="dropdown-item text-primary" href="edit-category.php?id=<?= $item['id']; ?>">Update</a>
                                                </li>
                                                <li>
                                                    <form action="code.php" method="POST" class="d-inline">
                                                        <input type="hidden" name="category_id" value="<?= $item['id']; ?>">
                                                        <button type="submit" class="dropdown-item text-danger" name="delete_category_btn" onclick="return confirm('Are you sure you want to delete this case?');">Delete</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='10' class='text-center'>No records found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php');?>
