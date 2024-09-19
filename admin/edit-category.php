<?php 

include('includes/header.php');
include('../middleware/adminMiddleware.php');

?>

<div class="container-lg m-5">
    <div class="row">
        <div class="col-md-12">
            <?php
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                $category = getByID("categories", $id);
                if(mysqli_num_rows($category) > 0)
                {
                    $data = mysqli_fetch_array($category);
                ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Category</h4>
                        </div>
                        <div class="card-body">
                                <form action="code.php" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                    <div class="col-md-6">
                                    <input type="hidden" name="category_id" value="<?= $data['id'] ?>">
                                    <label for="">STUDENT NUMBER</label>
                                    <input type="text" name="slug" value="<?= $data['slug']?>" placeholder="Enter Student number" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="">NAME</label>
                                    <input type="text" name="name" value="<?= $data['name']?>" placeholder="Enter Name" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label for="">POSITION</label>
                                    <textarea rows="3" name="description" placeholder="Enter Position" class="form-control"><?= $data['description'] ?> </textarea>
                                </div>
                                <div class="col-md-12">
                                    <label for="">CASE</label>
                                    <input type="text" name="meta_tittle" value="<?= $data['meta_tittle']?>" placeholder="Enter Case" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="">RESOLVED</label>
                                    <input type="checkbox" <?=$data['status'] ? "checked":"" ?> name="status">
                                </div>
                                <div class="col-md-6">
                                    <label for="">DECIDED</label>
                                    <input type="checkbox" <?=$data['popular'] ? "checked":"" ?> name="popular">
                                </div>
                                <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" name="update_category_btn">Update</button>
                                </div>
                                </div>
                            </form>
                    </div>    
                <?php
                }
                else
                {
                    echo "CATEGORY NOT FOUND";
                }
            }
            else
            {
                echo "ID missing from url";
            }
                ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php');?>