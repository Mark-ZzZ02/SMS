<?php 

include('includes/header.php');
include('../middleware/adminMiddleware.php');

?>

<div class="container-fluid p-4 bg-white text-black text-center" class="navbar-brand" >
</div>
<div class="container mt-5 ">
  <div class="row">
    <div class="col-md-12  p-4 shadow">
    <h4>USER LIST 
    <a href="add-user.php" class="btn btn-primary float-end">Add User</a>

    </h4>
    <table  class="table table-striped">
    <thead>
                            <tr>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>DATE CREATED</th>
                                <th>VERIFY</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody id="tbl_tbody">
                            <?php
                                $category = getAll("users");

                                if(mysqli_num_rows($category) > 0)
                                {
                                    foreach($category as $item)
                                    {
                                        ?>
                                        <tr>
                                        <td> <?= $item['name']; ?></td>
                                        <td> <?= $item['email']; ?></td>
                                        <td> <?= $item['create_at']; ?></td>
                                        <td> 
                                            <?php
                                            if($item['role_as'] == '1'){
                                                echo 'Approved';
                                            }
                                            elseif($item['role_as'] == '0'){
                                                echo 'Denied';
                                            }
                                            ?>

                                        <td>
                                            <form action="codeuser.php" method="POST">
                                                <input type="hidden" name="category_id" value="<?= $item['id']; ?>">
                                                <a href="edit-user.php?id=<?= $item['id']; ?>" class="btn btn-primary float" >EDIT</a>
                                                <button type="sumbit" class="btn btn-danger" name="delete_user_btn">DELETE</button>
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