<?php 

include('includes/header.php');
include('../middleware/adminMiddleware.php');

?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 p-4 shadow rounded bg-light">
            <h4 class="d-flex justify-content-between align-items-center">
                FACULTY
            </h4>
            <div class="table-responsive">
            <table class="table table-striped table-hover mt-3">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Student Name</th>
            <th>Parent Name</th>
            <th>Photo</th>
            <th>Meeting Status</th>
            <th>Date</th>
            <th>Advisor</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Juan Dela Cruz</td>
            <td>Pedro Dela Cruz</td>
            <td><img src="path/to/photo1.jpg" alt="Juan's Photo" width="50" class="rounded-circle"></td>
            <td>Attended</td>
            <td>2024-10-01</td>
            <td>Ms. Santos</td>
            <td>
                <button class="btn btn-warning btn-sm">Edit</button>
                <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?');">Delete</button>
            </td>
        </tr>
        <tr>
            <td>2</td>
            <td>Maria Clara</td>
            <td>Isabel Clara</td>
            <td><img src="path/to/photo2.jpg" alt="Maria's Photo" width="50" class="rounded-circle"></td>
            <td>Not Attended</td>
            <td>2024-10-02</td>
            <td>Mr. Reyes</td>
            <td>
                <button class="btn btn-warning btn-sm">Edit</button>
                <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?');">Delete</button>
            </td>
        </tr>
        <tr>
            <td>3</td>
            <td>Andres Bonifacio</td>
            <td>Teodoro Bonifacio</td>
            <td><img src="path/to/photo3.jpg" alt="Andres's Photo" width="50" class="rounded-circle"></td>
            <td>Attended</td>
            <td>2024-10-03</td>
            <td>Ms. Cruz</td>
            <td>
                <button class="btn btn-warning btn-sm">Edit</button>
                <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?');">Delete</button>
            </td>
        </tr>
        <tr>
            <td>4</td>
            <td>Emilio Aguinaldo</td>
            <td>Maria Aguinaldo</td>
            <td><img src="path/to/photo4.jpg" alt="Emilio's Photo" width="50" class="rounded-circle"></td>
            <td>Not Attended</td>
            <td>2024-10-04</td>
            <td>Mr. Lopez</td>
            <td>
                <button class="btn btn-warning btn-sm">Edit</button>
                <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?');">Delete</button>
            </td>
        </tr>
        <tr>
            <td>5</td>
            <td>Florence Nightingale</td>
            <td>Henry Nightingale</td>
            <td><img src="path/to/photo5.jpg" alt="Florence's Photo" width="50" class="rounded-circle"></td>
            <td>Attended</td>
            <td>2024-10-05</td>
            <td>Ms. Garcia</td>
            <td>
                <button class="btn btn-warning btn-sm">Edit</button>
                <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?');">Delete</button>
            </td>
        </tr>
    </tbody>
</table>

            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php');?>