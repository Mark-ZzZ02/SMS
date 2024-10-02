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
                                <label for="">PUNISHMENT</label>
                                <input type="text" name="punishment_id" value="<?= $data['punishment_id']?>" placeholder="Enter Name" class="form-control">
                                </div>
                                <div class="col-md-6">
                                <label for="">TYPE</label>
                                <input type="text" name="punishment_type" value="<?= $data['punishment_type']?>" placeholder="Enter Name" class="form-control">
                                </div>
                                <div class="col-md-6">
                                <label for="">DETAILS</label>
                                <input type="text" name="punishment_details" value="<?= $data['punishment_details']?>" placeholder="Enter Name" class="form-control">
                                </div>
                                <div class="col-md-6">
                                <label for="">INVESTIGATION</label>
                                <input type="text" name="investigation_notes" value="<?= $data['investigation_notes']?>" placeholder="Enter Name" class="form-control">
                                </div>
                                <div class="col-md-6">
                                <label for="">DATE ASSIGNED</label>
                                <input type="text" name="date_assigned" value="<?= $data['date_assigned']?>" placeholder="Enter Name" class="form-control">
                                </div>
                                <div class="col-md-6">
                                <label for="">ASSIGNED BY</label>
                                <input type="text" name="assigned_staff" value="<?= $data['assigned_staff']?>" placeholder="Enter Name" class="form-control">
                                </div>
                                <div class="col-md-6">
                                <label for="">COMPLECTION STATUS</label>
                                <input type="text" name="completion_status" value="<?= $data['completion_status']?>" placeholder="Enter Name" class="form-control">
                                </div>
                                <div class="col-md-6">
                                <label for="">COMPLECTION DATE</label>
                                <input type="text" name="completion_date" value="<?= $data['completion_date']?>" placeholder="Enter Name" class="form-control">
                                <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" name="update_punishment_btn">Update</button>
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