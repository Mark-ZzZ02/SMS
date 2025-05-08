<?php 

include('includes/header.php');
include('../middleware/adminMiddleware.php');

?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 p-4 shadow" style="background-image: linear-gradient( #ccffff, #e6ffe6, #ffffcc);">
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $category = getByID("categories", $id);
                if (mysqli_num_rows($category) > 0) {
                    $data = mysqli_fetch_array($category);
            ?>
                            <h2>Edit Punishment</h2>
                            
                            <form action="code.php" method="POST">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>
                                                <input type="hidden" name="category_id" value="<?= $data['id'] ?>">
                                                <label for="student_id">STUDENT ID</label>
                                                <input type="text" name="student_id" value="<?= $data['student_id'] ?>" class="form-control" readonly required>
                                            </td>
                                            <td>
                                                <label for="first_name">FIRST NAME</label>
                                                <input type="text" name="first_name" value="<?= $data['first_name'] ?>" class="form-control" readonly required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="surname">SURNAME</label>
                                                <input type="text" name="surname" value="<?= $data['surname'] ?>" class="form-control" readonly required>
                                            </td>
                                            <td>
                                                <label for="statement">STATEMENT</label>
                                                <input type="text" name="statement" value="<?= $data['statement'] ?>" placeholder="Enter Statement" class="form-control" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="case_id">CASE ID</label>
                                                <input type="text" name="case_id" value="<?= $data['case_id'] ?>" placeholder="Enter Case ID" class="form-control" required>
                                            </td>
                                            <td>
                                                <label for="offense_type">OFFENSE TYPE</label>
                                                <select name="offense_type" id="offense_type" class="form-control" required onchange="updateOffenseOptions(); updateSanctionOptions()">
                                                    <option value="Minor" <?= $data['offense_type'] === 'Minor' ? 'selected' : '' ?>>Minor</option>
                                                    <option value="Major" <?= $data['offense_type'] === 'Major' ? 'selected' : '' ?>>Major</option>
                                                    <option value="Grave" <?= $data['offense_type'] === 'Grave' ? 'selected' : '' ?>>Grave</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="offense_id">OFFENSE ID</label>
                                                <select name="offense_id" id="offense_id" class="form-control" required>
                                                    <?php
                                                    if ($data['offense_type']) {
                                                        $offenses = [
                                                            'Minor' => [
                                                                ["id" => "4.1.1.1", "description" => "NOT WEARING OF SCHOOL ID CARD"],
                                                            ],
                                                            'Major' => [
                                                                ["id" => "4.1.2.1", "description" => "UNAUTHORIZED BRINGING OUT OF SCHOOL FACILITIES"],
                                                            ],
                                                            'Grave' => [
                                                                ["id" => "4.1.3.1", "description" => "POSSESSION, USE OR SALE OF PROHIBITED DRUGS"],
                                                            ]
                                                        ];
                                                        foreach ($offenses[$data['offense_type']] as $offense) {
                                                            $selected = ($offense['id'] === $data['offense_id']) ? 'selected' : '';
                                                            echo "<option value='{$offense['id']}' {$selected}>{$offense['id']} - {$offense['description']}</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <label for="sanction">SANCTION</label>
                                                <select name="sanction" id="sanction" class="form-control" required>
                                                    <option value="" disabled>Select Sanction</option>
                                                    <?php
                                                    if ($data['offense_type']) {
                                                        $sanctions = [
                                                            'Minor' => [
                                                                "VERBAL OR WRITTEN REPRIMAND BY THE PREFECT OF DISCIPLINE",
                                                            ],
                                                            'Major' => [
                                                                "SUSPENSION FOR A MINIMUM OF THREE DAYS AND A MAXIMUM OF FIFTEEN",
                                                            ],
                                                            'Grave' => [
                                                                "EXCLUSION OR DISMISSAL",
                                                            ]
                                                        ];
                                                        foreach ($sanctions[$data['offense_type']] as $sanction) {
                                                            $selected = ($sanction === $data['sanction']) ? 'selected' : '';
                                                            echo "<option value='{$sanction}' {$selected}>{$sanction}</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="conclusions">CONCLUSIONS</label>
                                                <input type="text" name="conclusions" value="<?= $data['conclusions'] ?>" placeholder="Enter Conclusions" class="form-control" required>
                                            </td>
                                            <td>
                                                <label for="case_status">CASE STATUS</label>
                                                <select name="case_status" id="case_status" class="form-control" required>
                                                    <option value="" >Select Case Status</option>
                                                    <option value="Pending" <?= $data['case_status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
                                                    <option value="Ongoing" <?= $data['case_status'] === 'Ongoing' ? 'selected' : '' ?>>Ongoing</option>
                                                    <option value="Closed" <?= $data['case_status'] === 'Closed' ? 'selected' : '' ?>>Closed</option>
                                                </select>
                                            </td>
                                        </tr>
                                      <tr>
                                            <td>
                                                <label for="warning">WARNING STAGE</label>
                                                <select name="warning" class="form-control" required>
                                                    <option value="first" <?= $data['warning'] === 'First offense' ? 'selected' : '' ?>>First Warning</option>
                                                    <option value="second" <?= $data['warning'] === 'Second offense' ? 'selected' : '' ?>>Second Warning</option>
                                                    <option value="third" <?= $data['warning'] === 'Third offense' ? 'selected' : '' ?>>Third Warning</option>
                                                </select>
                                            </td>
                                             <td>
                                                <label for="completion_date">COMPLETION DATE</label>
                                                <input type="date" name="completion_date" value="<?= $data['completion_date'] ?>" class="form-control" required>
                                            </td>
                                        </tr>
                                        <tr>

                                            <td colspan="2" class="text-center">
                                                <button type="submit" class="btn btn-primary" name="update_punishment_btn">Update</button>
                                                <a href="punishment.php" class="btn btn-secondary">Close</a>
                                            </td>
                                        </tr>
                                        
                                    </table>
                                </div>
                            </form>
                 
            <?php
                } else {
                    echo "No Record Found";
                }
            } else {
                echo "ID not provided";
            }
            ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
