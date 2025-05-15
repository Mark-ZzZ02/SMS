<?php 

include('includes/header.php');
include('../middleware/adminMiddleware.php');

?>
<div class="container mt-5 px-5 py-3">
    <div class="row">
        <div class="col-md-12 p-4 shadow" style="background-image: linear-gradient( #ccffff, #e6ffe6, #ffffcc);">
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $category = getByID("categories", $id);
                if (mysqli_num_rows($category) > 0) {
                    $data = mysqli_fetch_array($category);
            ?>
        
                            <h4>Edit Parent List</h4>

                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input type="hidden" name="category_id" value="<?= $data['id'] ?>">
                                        <label for="student_id">STUDENT NUMBER</label>
                                        <input type="text" name="student_id" value="<?= $data['student_id'] ?>" class="form-control" readonly required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="surname">SURNAME</label>
                                        <input type="text" name="surname" value="<?= $data['surname'] ?>" class="form-control" readonly required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="first_name">FIRST NAME</label>
                                        <input type="text" name="first_name" value="<?= $data['first_name'] ?>" class="form-control" readonly required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="parent_name">PARENT NAME</label>
                                        <input type="text" name="parent_name" value="<?= $data['parent_name'] ?>" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="parent_contact">PARENT CONTACT</label>
                                        <div class="input-group">
                                            <span class="input-group-text">+63</span>
                                            <input type="text" name="parent_contact" value="<?= $data['parent_contact'] ?>" placeholder="Enter Parent Contact Number" class="form-control" required pattern="^[0-9]{10}$" title="Please enter a 10-digit phone number without the country code.">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="date_meeting">DATE MEETING</label>
                                        <input type="date" name="date_meeting" value="<?= $data['date_meeting'] ?>" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="case_status">CASE STATUS</label>
                                        <select name="case_status" id="case_status" class="form-control" required>
                                                    <option value="" disabled>Select Case Status</option>
                                                    <option value="Pending" <?= $data['case_status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
                                                    <option value="Ongoing" <?= $data['case_status'] === 'Ongoing' ? 'selected' : '' ?>>Ongoing</option>
                                                </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="statement">STATEMENT</label>
                                        <input type="text" name="statement" value="<?= $data['statement'] ?>" placeholder="Enter Statement" class="form-control" required>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="attendees">ATTENDEES</label>
                                        <input type="text" name="attendees" value="<?= $data['attendees'] ?>" placeholder="Enter Attendees" class="form-control" required>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="conclusions">CONCLUSIONS</label>
                                        <input type="text" name="conclusions" value="<?= $data['conclusions'] ?>" placeholder="Enter Conclusions" class="form-control" required>
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

<?php include('includes/footer.php'); ?>
