<?php 

include('includes/header.php');
include('../middleware/adminMiddleware.php');

?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 p-4 shadow rounded bg-light">
            <h4 class="d-flex justify-content-between align-items-center">
                STUDENT CASE LIST
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Add Case</button>
            </h4>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-hover mt-3">
                    <thead class="table-light-blue">
                        <tr>
                            <th class="text-center">STUDENT NUMBER</th>
                            <th class="text-center">NAME</th>
                            <th class="text-center">OFFENSE</th>
                            <th class="text-center">CASE</th>
                            <th class="text-center">DATE ADDED</th>
                            <th class="text-center">INVESTIGATION</th>
                            <th class="text-center">STATUS</th>
                            <th class="text-center">STAFF</th>
                            <th class="text-center">PUNISHMENT</th>
                            <th class="text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody id="tbl_tbody">
                        <?php
                            $category = getAll("categories");

                            if (mysqli_num_rows($category) > 0) {
                                foreach ($category as $item) {
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= $item['student_id']; ?></td>
                                        <td class="text-center"><?= $item['name']; ?></td>
                                        <td class="text-center"><?= $item['offense_id']; ?></td>
                                        <td class="text-center"><?= $item['case_id']; ?></td>
                                        <td class="text-center"><?= $item['date_added']; ?></td>
                                        <td class="text-center"><?= $item['investigation_notes']; ?></td>
                                        <td class="text-center"><?= $item['completion_status']; ?></td>
                                        <td class="text-center"><?= $item['assigned_staff']; ?></td>
                                        <td class="text-center"><?= $item['punishment_type']; ?></td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Actions
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <li>
                                                        <a class="dropdown-item text-primary" href="edit-category.php?id=<?= $item['id']; ?>">Update</a>
                                                    </li>
                                                    <li>
                                                        <form action="code.php" method="POST" class="d-inline">
                                                            <input type="hidden" name="category_id" value="<?= $item['id']; ?>">
                                                            <button type="submit" class="dropdown-item text-danger" name="delete_category_btn" onclick="return confirm('Are you sure you want to delete this case?');">Delete</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='10' class='text-center'>No records found</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
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

 <div class="modal" id="modaledit">
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
      <?php
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                $category = getByID("categories", $id);
                if(mysqli_num_rows($category) > 0)
                {
                    $data = mysqli_fetch_array($category);
                ?>
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
                                <button type="submit" class="btn btn-primary" name="update_categoryy_btn">Update</button>
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
        <div id="responseMessage" class="mt-3"></div>
        </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

            </div>
        </div>
        </div>

<?php include('includes/footer.php');?>