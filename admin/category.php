<?php 
include('includes/header.php');
include('../middleware/adminMiddleware.php');

$statusFilter = isset($_GET['status']) ? mysqli_real_escape_string($con, $_GET['status']) : '';

if (!empty($statusFilter)) {
    $query = "SELECT * FROM categories WHERE case_status='$statusFilter' ORDER BY id DESC";
} else {
    $query = "SELECT * FROM categories ORDER BY id DESC";
}

$category = mysqli_query($con, $query);
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 p-4 shadow rounded" style="background-image: linear-gradient( #ccffff, #e6ffe6, #ffffcc);">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>STUDENT CASE LIST</h4>
            </div>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-hover mt-3">
                    <thead>
                        <tr>
                            <th class="text-center">DATE</th>
                            <th class="text-center">STUDENT ID</th>
                            <th class="text-center">FIRST NAME</th>
                            <th class="text-center">SURNAME</th>
                            <th class="text-center">CASE ID</th>
                            <th class="text-center">STATUS</th>
                            <th class="text-center">COMPLETION DATE</th>
                            <th class="text-center">WARNING STAGE</th>
                            <th class="text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody id="offenseTableBody">
                        <?php
                        $category = mysqli_query($con, "SELECT * FROM categories ORDER BY id DESC");

                        if (mysqli_num_rows($category) > 0) {
                            foreach ($category as $item) {
                                ?>
                                <tr>
                                    <td class="text-center"><?= htmlspecialchars($item['date_added']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['student_id']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['first_name']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['surname']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['case_id']); ?></td>
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
                                    <td class="text-center"><?= htmlspecialchars($item['completion_date']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['warning']); ?></td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li>
                                                  <a class="dropdown-item text-primary" href="view-case.php?id=<?= $item['id']; ?>">View</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-primary" href="edit-category.php?id=<?= $item['id']; ?>">Update</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#deletionModal" onclick="setCategoryId(<?= $item['id']; ?>)">Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center'>No records found</td></tr>"; 
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Deletion Confirmation Modal -->
<div class="modal fade" id="deletionModal" tabindex="-1" aria-labelledby="deletionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletionModalLabel">Provide Reason for Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="deleteReasonForm" action="code.php" method="POST">
                    <input type="hidden" name="category_id" id="category_id">
                    <div class="mb-3">
                        <label for="deletion_reason" class="form-label">Reason for deletion</label>
                        <textarea class="form-control" id="deletion_reason" name="deletion_reason" rows="3" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger" name="delete_category_btn">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<script>
    function setCategoryId(id) {
        document.getElementById('category_id').value = id;
    }
</script>
