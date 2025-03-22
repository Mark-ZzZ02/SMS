<?php 
include('includes/header.php');
include('../middleware/adminMiddleware.php');
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 p-4 shadow rounded bg-light" style="background-image: linear-gradient( #ccffff, #e6ffe6, #ffffcc);">
            <h4 class="d-flex justify-content-between align-items-center">
                PARENT MEETING RECORD
            </h4>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-hover mt-3">
                    <thead>
                        <tr>
                            <th class="text-center">STUDENT NUMBER</th>
                            <th class="text-center">SURNAME</th>
                            <th class="text-center">FIRST NAME</th>
                            <th class="text-center">PARENT NAME</th>
                            <th class="text-center">CASE ID</th>
                            <th class="text-center">DATE MEETING</th>
                            <th class="text-center">CASE STATUS</th>
                            <th class="text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody id="tbl_tbody">
                        <?php
                            $category = getAll("categories");

                            if (mysqli_num_rows($category) > 0) {
                                foreach ($category as $item) {
                                    if ($item['case_status'] === 'Closed' || $item['offense_type'] === 'Minor') {
                                        continue; 
                                    }
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= htmlspecialchars($item['student_id']); ?></td>
                                        <td class="text-center"><?= htmlspecialchars($item['surname']); ?></td>
                                        <td class="text-center"><?= htmlspecialchars($item['first_name']); ?></td>
                                        <td class="text-center"><?= htmlspecialchars($item['parent_name']); ?></td>
                                        <td class="text-center"><?= htmlspecialchars($item['case_id']); ?></td>
                                        <td class="text-center"><?= htmlspecialchars($item['date_meeting']); ?></td>
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
