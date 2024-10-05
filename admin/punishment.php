<?php 

include('includes/header.php');
include('../middleware/adminMiddleware.php');

?>

<div class="container-fluid p-4 bg-white text-black text-center" class="navbar-brand" >
</div>
<div class="container mt-5 ">
  <div class="row">
    <div class="col-md-12  p-4 shadow">
    <h4>PUNISHMENT LIST
    </h4>
    <table class="table table-striped">
    <thead>
                            <tr>
                                <th>STUDENT NUMBER</th>
                                <th>NAME</th>
                                <th>CASE</th>
                                <th>PUNISHMENT TYPE</th>
                                <th>PUNISHMENT DETAILS</th>
                                <th>INVESTIGATION</th>
                                <th>STAFF</th>
                                <th>COMPLETION STATUS</th>
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
                                        <td> <?= $item['case_id']; ?></td>
                                        <td> <?= $item['punishment_type']; ?></td>
                                        <td> <?= $item['punishment_details']; ?></td>
                                        <td> <?= $item['investigation_notes']; ?></td>
                                        <td> <?= $item['assigned_staff']; ?></td>
                                        <td> <?= $item['completion_status']; ?></td>
                                        <td> <?= $item['completion_date']; ?></td>
                                        
                                        
                                        <td>
                                            <form action="code.php" method="POST">
                                                <input type="hidden" name="category_id" value="<?= $item['id']; ?>">
                                                <a href="edit-punishment.php?id=<?= $item['id']; ?>" class="btn btn-primary float" >UPDATE</a>
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

<?php include('includes/footer.php');?>