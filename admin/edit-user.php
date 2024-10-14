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
                $category = getByID("users", $id);
                if(mysqli_num_rows($category) > 0)
                {
                    $data = mysqli_fetch_array($category);
                ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Category</h4>
                        </div>
                        <div class="card-body">
                                <form action="codeuser.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="<?= $data['name']?>" placeholder="Enter Name" class="form-control">
                    </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" name="email" value="<?= $data['email']?>" class="form-control"  id="exampleInputEmail1" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" value="<?= $data['password']?>" class="form-control" placeholder="Enter your Password" id="exampleInputPassword1">
                  </div>
 
                  <button type="submit" name="update_user_btn" class="btn btn-primary">Submit</button>
                </form>
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

<?php include('includes/footer.php');?>
