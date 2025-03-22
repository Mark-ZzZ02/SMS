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
                            <th class="text-center">ID</th>
                            <th class="text-center">Student Name</th>
                            <th class="text-center">Parent Name</th>
                            <th class="text-center">Photo</th>
                            <th class="text-center">Meeting Status</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Advisor</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td class="text-center">Juan Dela Cruz</td>
                            <td class="text-center">Pedro Dela Cruz</td>
                            <td class="text-center">
                                <img src="path/to/photo1.jpg" alt="Juan's Photo" width="50" class="rounded-circle">
                            </td>
                            <td class="text-center">Attended</td>
                            <td class="text-center">2024-10-01</td>
                            <td class="text-center">Ms. Santos</td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm">Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?');">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td class="text-center">Maria Clara</td>
                            <td class="text-center">Isabel Clara</td>
                            <td class="text-center">
                                <img src="path/to/photo2.jpg" alt="Maria's Photo" width="50" class="rounded-circle">
                            </td>
                            <td class="text-center">Not Attended</td>
                            <td class="text-center">2024-10-02</td>
                            <td class="text-center">Mr. Reyes</td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm">Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?');">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td class="text-center">Andres Bonifacio</td>
                            <td class="text-center">Teodoro Bonifacio</td>
                            <td class="text-center">
                                <img src="path/to/photo3.jpg" alt="Andres's Photo" width="50" class="rounded-circle">
                            </td>
                            <td class="text-center">Attended</td>
                            <td class="text-center">2024-10-03</td>
                            <td class="text-center">Ms. Cruz</td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm">Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?');">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">4</td>
                            <td class="text-center">Emilio Aguinaldo</td>
                            <td class="text-center">Maria Aguinaldo</td>
                            <td class="text-center">
                                <img src="path/to/photo4.jpg" alt="Emilio's Photo" width="50" class="rounded-circle">
                            </td>
                            <td class="text-center">Not Attended</td>
                            <td class="text-center">2024-10-04</td>
                            <td class="text-center">Mr. Lopez</td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm">Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?');">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">5</td>
                            <td class="text-center">Florence Nightingale</td>
                            <td class="text-center">Henry Nightingale</td>
                            <td class="text-center">
                                <img src="path/to/photo5.jpg" alt="Florence's Photo" width="50" class="rounded-circle">
                            </td>
                            <td class="text-center">Attended</td>
                            <td class="text-center">2024-10-05</td>
                            <td class="text-center">Ms. Garcia</td>
                            <td class="text-center">
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

<?php include('includes/footer.php'); ?>
