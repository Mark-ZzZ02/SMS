<?php 

include('includes/header.php');
include('../middleware/adminMiddleware.php');

?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 p-4 shadow rounded" style="background-image: linear-gradient( #ccffff, #e6ffe6, #ffffcc);">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>STUDENT CASE LIST</h4>
            </div>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-hover mt-3">
                    <thead>
                        <tr>
                            <th class="text-center">DATE</th>
                            <th class="text-center">STUDENT ID</th>
                            <th class="text-center">FIRST NAME</th>
                            <th class="text-center">SURNAME</th>
                            <th class="text-center">CASE ID</th>
                            <th class="text-center">STATUS</th>
                            <th class="text-center">COMPLETION DATE</th>
                            <th class="text-center">WARNING STAGE</th>
                            <th class="text-center">ACTION</th>

                        </tr>
                    </thead>
                    <tbody id="offenseTableBody">
                        <?php
                        $category = mysqli_query($con, "SELECT * FROM categories ORDER BY id DESC");

                        if (mysqli_num_rows($category) > 0) {
                            foreach ($category as $item) {
                                ?>
                                <tr>
                                    <td class="text-center"><?= htmlspecialchars($item['date_added']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['student_id']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['first_name']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['surname']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['case_id']); ?></td>
                                    <td class="text-center">
                                        <?php
                                        $status = htmlspecialchars($item['case_status']);
                                        $badgeClass = '';

                                        switch ($status) {
                                            case 'Pending':
                                                $badgeClass = 'badge bg-success';
                                                break;
                                            case 'Closed':
                                                $badgeClass = 'badge bg-danger';
                                                break;
                                            case 'Ongoing':
                                                $badgeClass = 'badge bg-warning text-dark';
                                                break;
                                            default:
                                                $badgeClass = 'badge bg-secondary'; 
                                                break;
                                        }
                                        ?>
                                        <span class="<?= $badgeClass; ?>"><?= $status; ?></span>
                                    </td>
                                    <td class="text-center"><?= htmlspecialchars($item['completion_date']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['warning']); ?></td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li>
                                                  <a class="dropdown-item text-primary" href="view-case.php?id=<?= $item['id']; ?>">View</a>
                                                </li>
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
                            echo "<tr><td colspan='7' class='text-center'>No records found</td></tr>"; 
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
                <input type="number" name="student_id" placeholder="Enter Student Number" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="">NAME</label>
                <input type="text" name="name" placeholder="Enter Name" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="">PROGRAM</label>
                <input type="text" name="program" placeholder="Enter Program" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="">SECTION</label>
                <input type="text" name="section" placeholder="Enter Section" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="">MAJOR</label>
                <input type="text" name="major" placeholder="Enter Major" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="">EMAIL</label>
                <input type="email" name="sms_email" placeholder="Enter Email" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label for="">YEAR</label>
                <input type="text" name="year_level" placeholder="Enter Year Level" class="form-control" required>
              </div>
              <div class="col-md-12">
                <label for="">STATEMENT</label>
                <textarea name="statement" placeholder="Enter Statement" class="form-control" required></textarea>
              </div>
              <div class="col-md-6">
                <label for="">CASE ID</label>
                <input type="text" name="case_id" placeholder="Enter Case ID" class="form-control" required>
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
    </div>
  </div>
</div>



<?php include('includes/footer.php');?>
