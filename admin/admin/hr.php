<?php  
include('includes/header.php');
include('../middleware/adminMiddleware.php');
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 p-4 shadow rounded bg-light" style="background-image: linear-gradient(#ccffff, #e6ffe6, #ffffcc);">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>HR CASE LIST</h4>
            </div>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-hover mt-3">
                    <thead>
                        <tr>
                            <th class="text-center">STUDENT ID</th>
                            <th class="text-center">SURNAME</th>
                            <th class="text-center">FIRST NAME</th>
                            <th class="text-center">PROGRAM</th>
                            <th class="text-center">SECTION</th>
                            <th class="text-center">MAJOR</th>
                            <th class="text-center">EMAIL</th>
                            <th class="text-center">YEAR</th>
                            <th class="text-center">STATUS</th>
                        </tr>
                    </thead>
                    <tbody id="offenseTableBody">
                        <?php
                        $category = mysqli_query($con, "SELECT * FROM categories ORDER BY id DESC");

                        if (mysqli_num_rows($category) > 0) {
                            foreach ($category as $item) {
                                ?>
                                <tr>
                                    <td class="text-center"><?= htmlspecialchars($item['student_id']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['surname']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['first_name']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['program']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['section']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['major']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['sms_email']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['year_level']); ?></td>
                                    <td class="text-center">
                                        <?php
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
                                        <span class="<?= $badgeClass; ?>"><?= $status; ?></span>
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

<?php include('includes/footer.php'); ?>
