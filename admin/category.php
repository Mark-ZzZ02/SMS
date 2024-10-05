<?php 

include('includes/header.php');
include('../middleware/adminMiddleware.php');

?>

<div class="container-fluid p-4 bg-white text-black text-center" class="navbar-brand" >
</div>
<div class="container mt-5 ">
  <div class="row">
    <div class="col-md-12 p-4 shadow">
    <h4>STUDENT CASE LIST
    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#myModal">Add Case</button>
    </h4>
    <table id=table  class="table table-striped">
    <thead>
                            <tr>
                                <th>STUDENT NUMBER</th>
                                <th>NAME</th>
                                <th>OFFENSE</th>
                                <th>CASE</th>
                                <th>DATE ADDED</th>
                                <th>INVESTIGATION</th>
                                <th>STATUS</th>
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
                                        <td> <?= $item['completion_status']; ?></td>
                                        <td> <?= $item['assigned_staff']; ?></td>
                                        <td> <?= $item['punishment_type']; ?></td>
                                    
                                        
                                        <td>
                                        <form action="code.php" method="POST">
                                                <input type="hidden" name="category_id" value="<?= $item['id']; ?>">
                                                <a href="edit-category.php?id=<?= $item['id']; ?>" class="btn btn-primary" >UPDATE</a>
                                                <button type="sumbit" class="btn btn-danger" name="delete_category_btn">DELETE</button>
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
        <h4 class="modal-title">ADD CASE</h4>
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
                                <label for="offenseType">OFFENSE</label>
                                <select name="offense_id" class="form-control" id="offenseType" onchange="toggleCustomOffense()">
                                    <option value="" disabled selected>Select Offense</option>
                                    <option value="theft">Theft</option>
                                    <option value="assault">Assault</option>
                                    <option value="burglary">Burglary</option>
                                    <option value="fraud">Fraud</option>
                                    <option value="vandalism">Vandalism</option>
                                    <option value="drug_offense">Drug Offense</option>
                                    <option value="other">Other</option>
                                </select>
                                <input type="text" name="custom_offense" id="customOffense" placeholder="Enter Custom Offense" class="form-control mt-2" style="display: none;" oninput="updateOffenseValue()">
                            </div>
                            <div class="col-md-6">
                                <label for="caseStatus">CASE STATUS</label>
                                <select name="case_id" class="form-control" id="caseStatus">
                                    <option value="" disabled selected>Select Status</option>
                                    <option value="open">Open</option>
                                    <option value="under_investigation">Under Investigation</option>
                                    <option value="closed">Closed</option>
                                    <option value="on_hold">On Hold</option>
                                    <option value="resolved">Resolved</option>
                                </select>
                            </div>                
                            <div class="col-md-12 mt-2">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="add_categoryy_btn">Save</button>
                            </div>
                        </div>
                    </form>
    <div id="responseMessage" class="mt-3"></div>
</div>
 </div>

<?php include('includes/footer.php');?>