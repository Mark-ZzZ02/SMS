<?php 

include('includes/header.php');

?>

<div class="container-fluid p-4 bg-white text-black text-center" class="navbar-brand" >
</div>

<div class="container mt-5 ">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Case</h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">STUDENT NUMBER</label>
                                <input type="text" name="slug" placeholder="Enter Student number" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">NAME</label>
                                <input type="text" name="name" placeholder="Enter Name" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="">POSITION</label>
                                <textarea rows="3" name="description" placeholder="Enter Position" class="form-control"> </textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="">CASE</label>
                                <input type="text" name="meta_tittle" placeholder="Enter Case" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">RESOLVED</label>
                                <input type="checkbox" name="status">
                            </div>
                            <div class="col-md-6">
                                <label for="">DECIDED</label>
                                <input type="checkbox" name="popular">
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" name="add_category_btn">Save</button>
                            </div>
                        </div>
                    </form>
                    <div id="responseMessage" class="mt-3"></div>
</div>
      </div>

<?php include('includes/footer.php');?>