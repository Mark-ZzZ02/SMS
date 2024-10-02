<?php 

include('includes/header.php');
include('../middleware/adminMiddleware.php');

?>

<div class="container-fluid p-4 bg-white text-black text-center" class="navbar-brand" >
</div>
<div class="container mt-5 ">
  <div class="row">
    <div class="col-md-12  p-4 shadow">    <div class="row">
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
                                    <input type="text" name="student_id" value="<?= $data['student_id']?>" placeholder="Enter Student number" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="">NAME</label>
                                    <input type="text" name="name" value="<?= $data['name']?>" placeholder="Enter Name" class="form-control">
                                </div>
                                <div class="col-md-6">
                                <label for="">OFFENSE</label>
                                <input type="text" name="offense_id" value="<?= $data['offense_id']?>" placeholder="Enter Name" class="form-control">                                
                                </div>
                                <div class="col-md-6">
                                    <label for="">DESCRIPTION</label>
                                    <input type="text" name="description" value="<?= $data['description']?>" placeholder="Enter Name" class="form-control">                                
                                </div>
                                <div class="col-md-6">
                                    <label for="">CASE STATUS</label>
                                    <input type="text" name="case_id" value="<?= $data['case_id']?>" placeholder="Enter Name" class="form-control">                                
                                </div>
                                <div class="col-md-6">
                                    <label for="">DATE ADDED</label>
                                    <input type="text" name="date_added" value="<?= $data['date_added']?>" placeholder="Enter Name" class="form-control">                                
                                </div> 
                                <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" name="update_category_btn">Update</button>
                                <a href="category.php" class="btn btn-primary">close</a>
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