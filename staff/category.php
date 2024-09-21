<?php 

include('includes/header.php');
include('../middleware/adminMiddleware.php');

?>

<div class="container">
      <div class="row">
          <div class="col-md-12">
            <div class="card row mt-7">
                <div class="card-header">
                    <h4>STUDENT LIST</h4>
                </div>
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
                                            <a href="edit-category.php?id=<?= $item['id']; ?>" class="btn btn-primary">EDIT</a>
                                            <form action="code.php" method="POST">
                                                <input type="hidden" name="category_id" value="<?= $item['id']; ?>">
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