<?php 

include('includes/header.php');
include('../middleware/adminMiddleware.php');

?>
<div class="container-fluid p-4 bg-light text-dark text-center">
    <h1>Edit Parent List</h1>
</div>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 p-4 shadow">
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $category = getByID("categories", $id);
                if (mysqli_num_rows($category) > 0) {
                    $data = mysqli_fetch_array($category);
            ?>
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4>Edit Parent List</h4>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input type="hidden" name="category_id" value="<?= $data['id'] ?>">
                                        <label for="student_id">STUDENT NUMBER</label>
                                        <input type="text" name="student_id" value="<?= $data['student_id'] ?>" placeholder="Enter Student number" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="name">NAME</label>
                                        <input type="text" name="name" value="<?= $data['name'] ?>" placeholder="Enter Name" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="assigned_staff">STAFF</label>
                                        <input type="text" name="assigned_staff" value="<?= $data['assigned_staff'] ?>" placeholder="Enter Name" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="date_reported">MEETING DATE</label>
                                        <input type="date" name="date_reported" value="<?= $data['date_reported'] ?>" class="form-control" required>
                                    </div>
                                    <div class="col-md-7 mb-3">
                                        <label for="next_action">PARENT CONTACT</label>
                                        <input type="text" name="next_action" value="<?= $data['next_action'] ?>" placeholder="Enter Contact" class="form-control" required>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                       <label for="case_status">MEETING STATUS</label>
                                        <select name="case_status" class="form-control" required>
                                            <option value="">Select Status</option>
                                            <option value="Scheduled" <?= $data['case_status'] === 'Scheduled' ? 'selected' : '' ?>>Scheduled</option>
                                            <option value="Completed" <?= $data['case_status'] === 'Completed' ? 'selected' : '' ?>>Completed</option>
                                            <option value="Cancelled" <?= $data['case_status'] === 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                            <option value="Pending" <?= $data['case_status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
                                            <option value="Rescheduled" <?= $data['case_status'] === 'Rescheduled' ? 'selected' : '' ?>>Rescheduled</option>
                                        </select>
                                    </div>
                                       <div class="col-md-3 mb-3">
                                        <label for="case_priority">NOTE</label>
                                        <input type="text" name="case_priority" value="<?= $data['case_priority'] ?>" placeholder="Enter Note" class="form-control" required>
                                    </div>
                                    <div class="col-md-12 mt-3 text-center">
                                        <button type="submit" class="btn btn-primary" name="update_parent_btn">Update</button>
                                        <a href="punishment.php" class="btn btn-secondary">Close</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            <?php
                } else {
                    echo "<div class='alert alert-danger'>CATEGORY NOT FOUND</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>ID MISSING FROM URL</div>";
            }
            ?>
        </div>
    </div>
</div>



<?php include('includes/footer.php');?>