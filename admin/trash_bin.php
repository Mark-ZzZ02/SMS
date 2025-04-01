<?php
include('includes/header.php');
include('../middleware/adminMiddleware.php');
?>


<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 p-4 shadow rounded" style="background-image: linear-gradient(#ccffff, #e6ffe6, #ffffcc);">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>DELETED STUDENT CASES</h4>
            </div>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-hover mt-3">
                    <thead>
                        <tr>
                            <th class="text-center">DATE DELETED</th>
                            <th class="text-center">STUDENT ID</th>
                            <th class="text-center">FIRST NAME</th>
                            <th class="text-center">SURNAME</th>
                            <th class="text-center">CASE ID</th>
                            <th class="text-center">OFFENSE TYPE</th>
                            <th class="text-center">REASON</th>
                            <th class="text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM trash_bin  WHERE deleted_at IS NOT NULL ORDER BY deleted_at DESC";
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row = mysqli_fetch_array($query_run)) {
                                ?>
                                <tr>
                                    <td class="text-center"><?= htmlspecialchars($row['deleted_at']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($row['student_id']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($row['first_name']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($row['surname']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($row['case_id']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($row['offense_type']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($row['deletion_reason']); ?></td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-success dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li>
                                                    <form action="code.php" method="POST" class="d-inline">
                                                        <input type="hidden" name="category_id" value="<?= $row['id']; ?>">
                                                        <button type="submit" class="dropdown-item text-warning" name="restore_category_btn" onclick="return confirm('Are you sure you want to restore this case?');">Restore</button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form action="code.php" method="POST" class="d-inline">
                                                        <input type="hidden" name="category_id" value="<?= $row['id']; ?>">
                                                        <button type="submit" class="dropdown-item text-danger" name="permanent_delete_btn" onclick="return confirm('Are you sure you want to permanently delete this case?');">Delete Permanently</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='8' class='text-center'>No deleted records found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
