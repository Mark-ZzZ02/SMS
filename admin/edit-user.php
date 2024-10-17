<?php 

include('includes/header.php');
include('../middleware/adminMiddleware.php');

?>

<div class="container-fluid p-4 bg-white text-black text-center"></div>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 p-4 shadow">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $category = getByID("users", $id);
                        if (mysqli_num_rows($category) > 0) {
                            $data = mysqli_fetch_array($category);
                    ?>
                            <div class="card">
                                <div class="card-header">
                                    <h4>Edit User</h4>
                                </div>
                                <div class="card-body">
                                    <form action="codeuser.php" method="POST" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="name" value="<?= $data['name'] ?>" placeholder="Enter Name" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                                            <input type="text" name="email" value="<?= $data['email'] ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">New Password (leave blank to keep current)</label>
                                            <input type="password" name="password" value="<?= $data['password']?>" class="form-control" placeholder="Enter new Password" id="exampleInputPassword1">
                                            <small class="form-text text-muted">Your current password will remain unchanged if this field is left blank.</small>
                                        </div>
                                        <div class="mb-3">
                                            <label for="role" class="form-label">Role</label>
                                            <select name="role_as" class="form-control" id="role">
                                                <option value="1" <?= $data['role_as'] == 1 ? 'selected' : '' ?>>Approved</option>
                                                <option value="0" <?= $data['role_as'] == 0 ? 'selected' : '' ?>>Denied</option>
                                            </select>
                                        </div>
                                        <input type="hidden" name="old_image" value="<?= $data['image'] ?>">
                                        <input type="hidden" name="category_id" value="<?= $data['id'] ?>">
                                        <button type="submit" name="update_user_btn" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                    <?php
                        } else {
                            echo "USER NOT FOUND";
                        }
                    } else {
                        echo "ID missing from URL";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>





<?php include('includes/footer.php');?>
