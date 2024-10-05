<?php 

include('includes/header.php');
include('../middleware/adminMiddleware.php');

?>

<div class="container-fluid p-4 bg-white text-black text-center" class="navbar-brand" >
</div>
<div class="container mt-5 ">
  <div class="row">
    <div class="  p-4 shadow">    <div class="row">
        <div class="">
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
                            <h4>Edit Parent List</h4>
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
                                <label for="">STAFF</label>
                                <input type="text" name="assigned_staff" value="<?= $data['assigned_staff']?>" placeholder="Enter Name" class="form-control">
                                </div>
                                <div class="col-md-6">
                                <label for="">MEETING DATE</label>
                                <input type="date" name="date_reported" value="<?= $data['date_reported']?>" placeholder="Enter Name" class="form-control">
                                </div>
                                <div class="col-md-7">
                                <label for="">PARENT CONTACK</label>
                                <input type="text" name="next_action" value="<?= $data['next_action']?>" placeholder="Enter Name" class="form-control">
                                </div>
                                <div class="col-md-3">
                                <label for="">MEETING STATUS</label>
                                <input type="text" name="case_status" value="<?= $data['case_status']?>" placeholder="Enter Name" class="form-control">
                                </div>
                                <div class="col-md-3">
                                <label for="">NOTE</label>
                                <input type="text" name="case_priority" value="<?= $data['case_priority']?>" placeholder="Enter Name" class="form-control">
                                </div>
                                
                                <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" name="update_parent_btn">Update</button>
                                <a href="punishment.php" class="btn btn-primary">close</a>
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