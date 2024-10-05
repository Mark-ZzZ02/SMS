<?php 

include('includes/header.php');
include('../middleware/adminMiddleware.php');

?>

<div class="container-fluid p-4 bg-white text-black text-center" class="navbar-brand" >
</div>
<div class="container mt-5 ">
  <div class="row">
    <div class="col-md-12  p-4 shadow">    <div class="row">
        <div class="col-md-12">
            <?php
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                $category = getByID("categories", $id);
                if(mysqli_num_rows($category) > 0)
                {
                    $data = mysqli_fetch_array($category);
                ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Category</h4>
                        </div>
                        <div class="card-body">
                                <form action="code.php" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                    <div class="col-md-6">
                                    <input type="hidden" name="category_id" value="<?= $data['id'] ?>">
                                    <label for="">STUDENT NUMBER</label>
                                    <input type="text" name="student_id" value="<?= $data['student_id']?>" placeholder="Enter Student number" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="">NAME</label>
                                    <input type="text" name="name" value="<?= $data['name']?>" placeholder="Enter Name" class="form-control">
                                </div> 
                                
                                <div class="col-md-3">
                                <label for="">DATE ASSIGNED</label>
                                <input type="datetime" name="date_added" value="<?= $data['date_added']?>" placeholder="Enter Name" class="form-control">
                                </div>
                                <div class="col-md-6">
                                <label for="offenseType">OFFENSE</label>
                                <select name="offense_id" class="form-control" id="offenseType" onchange="toggleCustomOffense()"> 
                                    <option value="" disabled <?= empty($data['offense_id']) ? 'selected' : '' ?>>Select Offense</option>
                                    <option value="theft" <?= $data['offense_id'] === 'theft' ? 'selected' : '' ?>>Theft</option>
                                    <option value="assault" <?= $data['offense_id'] === 'assault' ? 'selected' : '' ?>>Assault</option>
                                    <option value="burglary" <?= $data['offense_id'] === 'burglary' ? 'selected' : '' ?>>Burglary</option>
                                    <option value="fraud" <?= $data['offense_id'] === 'fraud' ? 'selected' : '' ?>>Fraud</option>
                                    <option value="vandalism" <?= $data['offense_id'] === 'vandalism' ? 'selected' : '' ?>>Vandalism</option>
                                    <option value="drug_offense" <?= $data['offense_id'] === 'drug_offense' ? 'selected' : '' ?>>Drug Offense</option>
                                    <option value="other" <?= $data['offense_id'] === 'other' ? 'selected' : '' ?>>Other</option>
                                </select>
                                <input type="text" name="custom_offense" id="customOffense" placeholder="Enter Custom Offense" class="form-control mt-2" style="display: none;" oninput="updateOffenseValue()">
                            </div>
                            <div class="col-md-6">
                                    <label for="caseStatus">CASE STATUS</label>
                                    <select name="case_id" class="form-control" id="caseStatus">
                                        <option value="" disabled <?= empty($data['case_id']) ? 'selected' : '' ?>>Select Status</option>
                                        <option value="open" <?= $data['case_id'] === 'open' ? 'selected' : '' ?>>Open</option>
                                        <option value="under_investigation" <?= $data['case_id'] === 'under_investigation' ? 'selected' : '' ?>>Under Investigation</option>
                                        <option value="closed" <?= $data['case_id'] === 'closed' ? 'selected' : '' ?>>Closed</option>
                                        <option value="on_hold" <?= $data['case_id'] === 'on_hold' ? 'selected' : '' ?>>On Hold</option>
                                        <option value="resolved" <?= $data['case_id'] === 'resolved' ? 'selected' : '' ?>>Resolved</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" name="update_category_btn">Update</button>
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
        </div>
    </div>
</div>

<?php include('includes/footer.php');?>