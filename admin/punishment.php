<?php 

include('includes/header.php');
include('../middleware/adminMiddleware.php');

?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 p-4 shadow rounded bg-light">
            <h4 class="d-flex justify-content-between align-items-center">
                PUNISHMENT LIST
            </h4>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-hover mt-3">
                    <thead class="table-light-blue">
                        <tr>
                            <th class="text-center">STUDENT NUMBER</th>
                            <th class="text-center">NAME</th>
                            <th class="text-center">CASE</th>
                            <th class="text-center">PUNISHMENT TYPE</th>
                            <th class="text-center">PUNISHMENT DETAILS</th>
                            <th class="text-center">INVESTIGATION</th>
                            <th class="text-center">STAFF</th>
                            <th class="text-center">COMPLETION STATUS</th>
                            <th class="text-center">COMPLETION DATE</th>
                            <th class="text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody id="tbl_tbody">
                        <?php
                            $category = getAll("categories");

                            if (mysqli_num_rows($category) > 0) {
                                foreach ($category as $item) {
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= $item['student_id']; ?></td>
                                        <td class="text-center"><?= $item['name']; ?></td>
                                        <td class="text-center"><?= $item['case_id']; ?></td>
                                        <td class="text-center"><?= $item['punishment_type']; ?></td>
                                        <td class="text-center"><?= $item['punishment_details']; ?></td>
                                        <td class="text-center"><?= $item['investigation_notes']; ?></td>
                                        <td class="text-center"><?= $item['assigned_staff']; ?></td>
                                        <td class="text-center"><?= $item['completion_status']; ?></td>
                                        <td class="text-center"><?= $item['completion_date']; ?></td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Actions
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <li>
                                                        <a class="dropdown-item text-primary" href="edit-punishment.php?id=<?= $item['id']; ?>">Update</a>
                                                    </li>
                                                    <li>
                                                        <form action="code.php" method="POST" class="d-inline">
                                                            <input type="hidden" name="category_id" value="<?= $item['id']; ?>">
                                                            <button type="submit" class="dropdown-item text-danger" name="delete_category_btn" onclick="return confirm('Are you sure you want to delete this punishment?');">Delete</button>
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