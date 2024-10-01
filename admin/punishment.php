<?php 

include('includes/header.php');
include('../middleware/adminMiddleware.php');

?>

<div class="container-fluid p-4 bg-white text-black text-center" class="navbar-brand" >
</div>
<div class="container mt-5 ">
  <div class="row">
    <div class="col-md-12  p-4 shadow">
    <h4>OFFENSE LIST
    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#myModal">Add Student</button>
    </h4>
    <table class="table table-striped">
    <thead>
                            <tr>
                                <th>STUDENT NUMBER</th>
                                <th>NAME</th>
                                <th>PUNISHMENT</th>
                                <th>CASE</th>
                                <th>TYPE</th>
                                <th>DETAILS</th>
                                <th>DATE ASSIGNÉD</th>
                                <th>ASSIGNED BY</th>
                                <th>COMPLECTION STATUS</th>
                                <th>COMPLECTION DATE</th>
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
                                        <td> <?= $item['punishment_id']; ?></td>
                                        <td> <?= $item['case_id']; ?></td>
                                        <td> <?= $item['punishment_type']; ?></td>
                                        <td> <?= $item['punishment_details']; ?></td>
                                        <td> <?= $item['date_assigned']; ?></td>
                                        <td> <?= $item['assigned_by']; ?></td>
                                        <td> <?= $item['completion_status']; ?></td>
                                        <td> <?= $item['completion_date']; ?></td>
                                        
                                        
                                        <td>
                                            <form action="code.php" method="POST">
                                                <input type="hidden" name="category_id" value="<?= $item['id']; ?>">
                                                <a href="edit-punishment.php?id=<?= $item['id']; ?>" class="btn btn-primary float" >EDIT</a>
                                                <button type="sumbit" class="btn btn-danger" name="delete_punishment_btn">Delete</button>
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
                                <label for="">OFFENSE</label>
                                <input type="text" name="offense_id" placeholder="Enter Student number" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">investigation</label>
                                <input type="text" name="investigation_notes" placeholder="Enter investigation notes" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="add_punishment_btn">Save</button>
                            </div>
                        </div>
                    </form>
    <div id="responseMessage" class="mt-3"></div>
</div>
 </div>

<?php include('includes/footer.php');?>