<?php 

include('includes/header.php');
include('../middleware/adminMiddleware.php');

?>

<div class="container-fluid p-4 bg-white text-black text-center" class="navbar-brand" >
</div>

<div class="container mt-5 ">



  <div class="row">
    <div class="col-md-12  p-4 shadow">

    
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Add Student</button>

    <table class="table table-striped">
    <thead>
                            <tr>
                                <th>Student number</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Case</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbl_tbody">
                            <?php
                                $category = getAll("categories");

                                if(mysqli_num_rows($category) > 0)
                                {
                                    foreach($category as $item)
                                    {
                                        ?>
                                        <tr>
                                        <td> <?= $item['slug']; ?></td>
                                        <td> <?= $item['name']; ?></td>
                                        <td> <?= $item['description']; ?></td>
                                        <td> <?= $item['meta_tittle']; ?></td>
                                        
                                        <td>
                                             <?= $item['status'] == '0'? "RESOLVED":"DECIDED" ?>
                                        </td>
                                        <td>
                                            <form action="code.php" method="POST">
                                                <input type="hidden" name="category_id" value="<?= $item['id']; ?>">
                                                <a href="edit-category.php?id=<?= $item['id']; ?>" class="btn btn-primary float" >EDIT</a>
                                                <button type="sumbit" class="btn btn-danger" name="delete_category_btn">Delete</button>
                                            </form>
                                        </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                else
                                {
                                    echo"No records found";
                                }
                            ?>
 </tbody>
  </table>
    </div>
  </div>
  <!-- INSERT -->

  <div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Student</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <div class="container mt-5">
    <h2>Insert New Item</h2>
    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">STUDENT NUMBER</label>
                                <input type="text" name="slug" placeholder="Enter Student number" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">NAME</label>
                                <input type="text" name="name" placeholder="Enter Name" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="">POSITION</label>
                                <textarea rows="3" name="description" placeholder="Enter Position" class="form-control"> </textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="">CASE</label>
                                <input type="text" name="meta_tittle" placeholder="Enter Case" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">RESOLVED</label>
                                <input type="checkbox" name="status">
                            </div>
                            <div class="col-md-6">
                                <label for="">DECIDED</label>
                                <input type="checkbox" name="popular">
                            </div>
                            <div class="col-md-12">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="add_category_btn">Save</button>
                            </div>
                        </div>
                    </form>
    <div id="responseMessage" class="mt-3"></div>
</div>
 </div>

<?php include('includes/footer.php');?>