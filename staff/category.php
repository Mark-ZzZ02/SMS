<?php 

include('includes/header.php');
include('../middleware/adminMiddleware.php');

?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 p-4 shadow rounded bg-light">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>STUDENT CASE LIST</h4>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Add Case</button>
            </div>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-hover mt-3">
                    <thead>
                        <tr>
                            <th class="text-center">STUDENT NUMBER</th>
                            <th class="text-center">NAME</th>
                            <th class="text-center">OFFENSE</th>
                            <th class="text-center">OFFENSE TYPE</th>
                            <th class="text-center">CASE ID</th>
                            <th class="text-center">DATE ADDED</th>
                            <th class="text-center">INVESTIGATION</th>
                            <th class="text-center">STATUS</th>
                            <th class="text-center">STAFF</th>
                            <th class="text-center">PUNISHMENT</th>
                            <th class="text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody id="offenseTableBody">
                        <?php
                        // Ensure you have a valid database connection $con
                        $category = mysqli_query($con, "SELECT * FROM categories ORDER BY id DESC");

                        if (mysqli_num_rows($category) > 0) {
                            foreach ($category as $item) {
                                ?>
                                <tr>
                                    <td class="text-center"><?= htmlspecialchars($item['student_id']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['name']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['offense_id']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['offense_type']); ?></td> <!-- New cell for offense type -->
                                    <td class="text-center"><?= htmlspecialchars($item['case_id']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['date_added']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['investigation_notes']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['completion_status']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['assigned_staff']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['punishment_type']); ?></td>
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
                            echo "<tr><td colspan='11' class='text-center'>No records found</td></tr>"; // Updated colspan to 11
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
                <input type="number" name="student_id" placeholder="Enter Student number" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="">NAME</label>
                <input type="text" name="name" placeholder="Enter Name" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="offenseType">OFFENSE</label>
                <select name="offense_id" class="form-control" id="offenseType" onchange="toggleCustomOffense()" required>
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
                <label for="offenseType">OFFENSE TYPE</label>
                <select name="offense_type" class="form-control" required>
                  <option value="" disabled selected>Select Offense Type</option>
                  <option value="major">Major</option>
                  <option value="minor">Minor</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="">CASE ID</label>
                <input type="text" name="case_id" placeholder="Enter Case" class="form-control" required>
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
    </div>
  </div>
</div>


<?php include('includes/footer.php');?>
