<?php 

include('includes/header.php');
include('../middleware/adminMiddleware.php');

?>

<div class="container-fluid p-4 bg-white text-black text-center" class="navbar-brand" >
</div>
<div class="container mt-5 ">
  <div class="row">
    <div class="col-md-12 p-4 shadow">
    <h4>STUDENT LIST
    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#myModal">Add Student</button>
    </h4>
    <table id=table  class="table table-striped">
    <thead>
                            <tr>
                                <th>STUDENT NUMBER</th>
                                <th>NAME</th>
                                <th>OFFENSE</th>
                                <th>CASE</th>
                                <th>DATE OF OFFENSE</th>
                                <th>INVESTIGATION</th>
                                <th>LAST UPDATED</th>
                                <th>NEXT ACTION</th>
                                <th>STAFF</th>
                                <th>PUNISHMENT</th>
                                <th>ACTION</th>
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
                                        <td> <?= $item['student_id']; ?></td>
                                        <td> <?= $item['name']; ?></td>
                                        <td> <?= $item['offense_id']; ?></td>
                                        <td> <?= $item['case_id']; ?></td>
                                        <td> <?= $item['date_added']; ?></td>
                                        <td> <?= $item['investigation_notes']; ?></td>
                                        <td> <?= $item['last_updated']; ?></td>
                                        <td> <?= $item['completion_status']; ?></td>
                                        <td> <?= $item['assigned_staff']; ?></td>
                                        <td> <?= $item['punishment_id']; ?></td>
                                    
                                        
                                        <td>
                                            <form action="code.php" method="POST">
                                                <input type="hidden" name="category_id" value="<?= $item['id']; ?>">
                                                <a href="edit-category.php?id=<?= $item['id']; ?>" class="btn btn-primary float" >UPDATE</a>
                                                <button type="sumbit" class="btn btn-danger mt-2" name="delete_category_btn">DELETE</button>
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
      <div class="container mt-2">
    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">STUDENT NUMBER</label>
                                <input type="text" name="student_id" placeholder="Enter Student number" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">NAME</label>
                                <input type="text" name="name" placeholder="Enter Case" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">OFFENSE</label>
                                <input type="text" name="offense_id" placeholder="Enter Offense date" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">DATE OFFENSE</label>
                                <input type="text" name="date_of_offense" placeholder="Enter Offense date" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">DESCRIPTION</label>
                                <input type="text" name="description" placeholder="Enter Description" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">CASE STATUS</label>
                                <input type="text" name="case_id" placeholder="Enter Status" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">DATE ADDED</label>
                                <input type="text" name="date_added" placeholder="Enter DATE" class="form-control">
                            </div>                        
                            <div class="col-md-12 mt-2">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="add_category_btn">Save</button>
                            </div>
                        </div>
                    </form>
    <div id="responseMessage" class="mt-3"></div>
</div>
 </div>

<?php include('includes/footer.php');?>