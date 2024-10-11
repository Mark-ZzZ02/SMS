<?php 

include('includes/header.php');
include('../middleware/adminMiddleware.php');

?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 p-4 shadow rounded bg-light">
            <h4 class="d-flex justify-content-between align-items-center">
                PARENT MEETING RECORD
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Add Meeting</button>
            </h4>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-hover mt-3">
                    <thead class="table-light-blue">
                        <tr>
                            <th class="text-center">STUDENT NUMBER</th>
                            <th class="text-center">STUDENT NAME</th>
                            <th class="text-center">CASE</th>
                            <th class="text-center">STAFF</th>
                            <th class="text-center">MEETING DATE</th>
                            <th class="text-center">PARENT CONTACT</th>
                            <th class="text-center">MEETING STATUS</th>
                            <th class="text-center">NOTE</th>
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
                                        <td class="text-center"><?= $item['assigned_staff']; ?></td>
                                        <td class="text-center"><?= $item['date_reported']; ?></td>
                                        <td class="text-center"><?= $item['next_action']; ?></td>
                                        <td class="text-center"><?= $item['case_status']; ?></td>
                                        <td class="text-center"><?= $item['case_priority']; ?></td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Actions
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <li>
                                                        <a class="dropdown-item text-primary" href="edit-parent.php?id=<?= $item['id']; ?>">Update</a>
                                                    </li>
                                                    <li>
                                                        <form action="code.php" method="POST" class="d-inline">
                                                            <input type="hidden" name="category_id" value="<?= $item['id']; ?>">
                                                            <button type="submit" class="dropdown-item text-danger" name="delete_category_btn" onclick="return confirm('Are you sure you want to delete this meeting record?');">Delete</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='9' class='text-center'>No records found</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php');?>