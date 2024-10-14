<?php 

include('includes/header.php');
include('../middleware/adminMiddleware.php');

?>
<div class="container-fluid p-4 bg-light text-dark text-center">
    <h1>Edit Punishment</h1>
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
                            <h4>Edit Punishment</h4>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <input type="hidden" name="category_id" value="<?= $data['id'] ?>">
                                        <label for="student_id">Student Number</label>
                                        <input type="text" name="student_id" value="<?= $data['student_id'] ?>" placeholder="Enter Student Number" class="form-control" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" value="<?= $data['name'] ?>" placeholder="Enter Name" class="form-control" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="punishmentType">Punishment Type</label>
                                        <select name="punishment_type" class="form-control" id="punishmentType" required>
                                            <option value="" disabled <?= empty($data['punishment_type']) ? 'selected' : '' ?>>Select Punishment</option>
                                            <option value="suspension" <?= $data['punishment_type'] === 'suspension' ? 'selected' : '' ?>>Suspension</option>
                                            <option value="detention" <?= $data['punishment_type'] === 'detention' ? 'selected' : '' ?>>Detention</option>
                                            <option value="warning" <?= $data['punishment_type'] === 'warning' ? 'selected' : '' ?>>Warning</option>
                                            <option value="expulsion" <?= $data['punishment_type'] === 'expulsion' ? 'selected' : '' ?>>Expulsion</option>
                                            <option value="probation" <?= $data['punishment_type'] === 'probation' ? 'selected' : '' ?>>Probation</option>
                                            <option value="reprimand" <?= $data['punishment_type'] === 'reprimand' ? 'selected' : '' ?>>Reprimand</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="punishment_details">Punishment Details</label>
                                        <input type="text" name="punishment_details" value="<?= $data['punishment_details'] ?>" placeholder="Enter Details" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="investigation_notes">Investigation</label>
                                        <input type="text" name="investigation_notes" value="<?= $data['investigation_notes'] ?>" placeholder="Enter Notes" class="form-control">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="assigned_staff">Assigned By</label>
                                        <input type="text" name="assigned_staff" value="<?= $data['assigned_staff'] ?>" placeholder="Enter Name" class="form-control" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="caseStatus">CASE STATUS</label>
                                    <select name="completion_status" class="form-control" id="caseStatus">
                                        <option value="" disabled <?= empty($data['completion_status']) ? 'selected' : '' ?>>Select Status</option>
                                        <option value="open" <?= $data['completion_status'] === 'open' ? 'selected' : '' ?>>Open</option>
                                        <option value="under_investigation" <?= $data['completion_status'] === 'under_investigation' ? 'selected' : '' ?>>Under Investigation</option>
                                        <option value="closed" <?= $data['completion_status'] === 'closed' ? 'selected' : '' ?>>Closed</option>
                                        <option value="on_hold" <?= $data['completion_status'] === 'on_hold' ? 'selected' : '' ?>>On Hold</option>
                                        <option value="resolved" <?= $data['completion_status'] === 'resolved' ? 'selected' : '' ?>>Resolved</option>
                                    </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="completion_date">Completion Date</label>
                                        <input type="date" name="completion_date" value="<?= $data['completion_date'] ?>" class="form-control">
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <button type="submit" class="btn btn-primary" name="update_punishment_btn">Update</button>
                                        <a href="punishment.php" class="btn btn-secondary">Close</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            <?php
                } else {
                    echo "<div class='alert alert-danger'>Category Not Found</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>ID Missing from URL</div>";
            }
            ?>
        </div>
    </div>
</div>



<?php include('includes/footer.php');?>