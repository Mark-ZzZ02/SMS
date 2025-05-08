<?php 
session_start();
include('includes/header.php');
include('../middleware/adminMiddleware.php');

?>

<div class="container-fluid p-4 bg-white text-black text-center" casaslass="navbar-brand" >
</div>
<div class="container mt-5 ">
  <div class="row">
    <div class="col-md-8 p-4 shadow" style="background-image: linear-gradient( #ccffff, #e6ffe6, #ffffcc);"> 
        <div class="col-md-12">
        <h4>ADD STUDENT</h4>
                <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-5">
                                <label for="">STUDENT NUMBER</label>
                                <input type="text" name="student_id" placeholder="Enter Student Number" class="form-control">
                            </div>
                            <div class="col-md-5">
                                <label for="">NAME</label>
                                <input type="text" name="name" placeholder="Enter Name" class="form-control">
                            </div>
                            <div class="col-md-3">
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
                            <div class="col-md-3">
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
                            <a href="category.php" class="btn btn-primary">close</a>
                            <button type="submit" class="btn btn-primary" name="add_categoryy_btn">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php');?>