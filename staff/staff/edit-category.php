<?php 

include('includes/header.php');
include('../middleware/adminMiddleware.php');

?>
<div class="container-fluid p-4 bg-light text-dark text-center">
    <h1>Edit Category</h1>
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
                            <h4>Edit Category</h4>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>
                                                <input type="hidden" name="category_id" value="<?= $data['id'] ?>">
                                                <label for="student_id">STUDENT NUMBER</label>
                                                <input type="text" name="student_id" value="<?= $data['student_id'] ?>" placeholder="Enter Student number" class="form-control" required>
                                            </td>
                                            <td>
                                                <label for="name">NAME</label>
                                                <input type="text" name="name" value="<?= $data['name'] ?>" placeholder="Enter Name" class="form-control" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="offenseType">OFFENSE</label>
                                                <select name="offense_id" class="form-control" id="offenseType" onchange="toggleCustomOffense()" required>
                                                    <option value="" disabled <?= empty($data['offense_id']) ? 'selected' : '' ?>>Select Offense</option>
                                                    <option value="theft" <?= $data['offense_id'] === 'theft' ? 'selected' : '' ?>>Theft</option>
                                                    <option value="assault" <?= $data['offense_id'] === 'assault' ? 'selected' : '' ?>>Assault</option>
                                                    <option value="burglary" <?= $data['offense_id'] === 'burglary' ? 'selected' : '' ?>>Burglary</option>
                                                    <option value="fraud" <?= $data['offense_id'] === 'fraud' ? 'selected' : '' ?>>Fraud</option>
                                                    <option value="vandalism" <?= $data['offense_id'] === 'vandalism' ? 'selected' : '' ?>>Vandalism</option>
                                                    <option value="drug_offense" <?= $data['offense_id'] === 'drug_offense' ? 'selected' : '' ?>>Drug Offense</option>
                                                    <option value="other" <?= $data['offense_id'] === 'other' ? 'selected' : '' ?>>Other</option>
                                                </select>
                                                <input type="text" name="custom_offense" id="customOffense" placeholder="Enter Custom Offense" class="form-control mt-2" style="display: none;" oninput="updateOffenseValue()">
                                            </td>
                                            <td>
                                                <label for="name">CASE ID</label>
                                                <input type="text" name="case_id" value="<?= $data['case_id'] ?>" placeholder="Enter Case ID" class="form-control" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="offenseType">OFFENSE TYPE</label>
                                                <select name="offense_type" class="form-control" required>
                                                    <option value="" disabled>Select Offense Type</option>
                                                    <option value="major" <?= $data['offense_type'] === 'major' ? 'selected' : '' ?>>Major</option>
                                                    <option value="minor" <?= $data['offense_type'] === 'minor' ? 'selected' : '' ?>>Minor</option>
                                                </select>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-center">
                                                <button type="submit" class="btn btn-primary" name="update_category_btn">Update</button>
                                                <a href="category.php" class="btn btn-secondary">Close</a>
                                            </td>
                                        </tr>
                                    </table>
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