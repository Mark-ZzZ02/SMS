<?php 

include('includes/header.php');
include('../middleware/adminMiddleware.php');

?>

<div class="container-fluid p-4 bg-white text-black text-center" class="navbar-brand" >
</div>
<div class="container mt-5 ">
  <div class="row">
    <div class="col-md-12  p-4 shadow">
    <h4>PARENT MEETING RECORD
    </h4>
    <table class="table table-striped">
    <thead>
                            <tr>
                                <th>STUDENT NUMBER</th>
                                <th>STUDENT NAME</th>
                                <th>CASE</th>
                                <th>STAFF</th>
                                <th>MEETING DATE</th>
                                <th>PARENT CONTACT</th>
                                <th>MEETING STATUS</th>
                                <th>NOTE</th>
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
                                        <td> <?= $item['assigned_staff']; ?></td>
                                        <td> <?= $item['date_reported']; ?></td>
                                        <td> <?= $item['next_action']; ?></td>
                                        <td> <?= $item['case_status']; ?></td>
                                        <td> <?= $item['case_priority']; ?></td>
                                        
                                        
                                        <td>
                                            <form action="code.php" method="POST">
                                                <input type="hidden" name="category_id" value="<?= $item['id']; ?>">
                                                <a href="edit-parent.php?id=<?= $item['id']; ?>" class="btn btn-primary float" >UPDATE</a>
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

<?php include('includes/footer.php');?>