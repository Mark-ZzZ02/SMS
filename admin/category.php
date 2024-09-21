<?php 

include('includes/header.php');
include('../middleware/adminMiddleware.php');

?>

<div class="modal fade" id="insetdata" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="insetdataLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="insetdataLabel">STUDENT LIST</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
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
                </div>
      </div>
    </div>
  </div>
</div>

<div class="container">
      <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>STUDENT LIST</h4>
                    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#insetdata">ADD STUDENT</button>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
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
                        <tbody>
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
                                                <a href="edit-category.php?id=<?= $item['id']; ?>" class="btn btn-primary">EDIT</a>
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
        </div>
    </div>
</div>

<?php include('includes/footer.php');?>