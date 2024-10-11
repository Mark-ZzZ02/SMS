<?php 

include('includes/header.php');
include('../middleware/adminMiddleware.php');

?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 p-4 shadow rounded bg-light">
            <h4 class="d-flex justify-content-between align-items-center">
                USER LIST 
                <a href="add-user.php" class="btn btn-primary">Add User</a>
            </h4>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-hover mt-3">
                    <thead class="table-light-blue">
                        <tr>
                            <th class="text-center">NAME</th>
                            <th class="text-center">EMAIL</th>
                            <th class="text-center">DATE CREATED</th>
                            <th class="text-center">VERIFY</th>
                            <th class="text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody id="tbl_tbody">
                        <?php
                            $category = getAll("users");

                            if (mysqli_num_rows($category) > 0) {
                                foreach ($category as $item) {
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= $item['name']; ?></td>
                                        <td class="text-center"><?= $item['email']; ?></td>
                                        <td class="text-center"><?= $item['create_at']; ?></td>
                                        <td class="text-center">
                                            <?php
                                            if ($item['role_as'] == '1') {
                                                echo 'Approved';
                                            } elseif ($item['role_as'] == '0') {
                                                echo 'Denied';
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Actions
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <li>
                                                        <a class="dropdown-item text-primary" href="edit-user.php?id=<?= $item['id']; ?>">Edit</a>
                                                    </li>
                                                    <li>
                                                        <form action="codeuser.php" method="POST" class="d-inline">
                                                            <input type="hidden" name="category_id" value="<?= $item['id']; ?>">
                                                            <button type="submit" class="dropdown-item text-danger" name="delete_user_btn" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='5' class='text-center'>No records found</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php');?>