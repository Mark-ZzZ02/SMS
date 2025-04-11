<?php 
include('includes/header.php');
include('../middleware/adminMiddleware.php');

$apiUrl = 'https://mis.schoolmanagementsystem2.com/mis_api.php'; 
$response = file_get_contents($apiUrl);
$students = json_decode($response, true); 

function sendDataToMis($data) {
    $url = 'https://prefect.schoolmanagementsystem2.com/send_to_mis.php'; 

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    } else {
        echo 'Response from MIS: ' . $response;
    }

    curl_close($ch);
}

?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 p-4 shadow rounded bg-light" style="background-image: linear-gradient( #ccffff, #e6ffe6, #ffffcc);">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>REGISTER OFFENSE</h4>
            </div>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-hover mt-3">
                    <thead>
                        <tr>
                            <th class="text-center">STUDENT NUMBER</th>
                            <th class="text-center">FIRST NAME</th>
                            <th class="text-center">MIDDLE NAME</th>
                            <th class="text-center">SURNAME</th>
                            <th class="text-center">PROGRAM</th>
                            <th class="text-center">SECTION</th>
                            <th class="text-center">MAJOR</th>
                            <th class="text-center">EMAIL</th>
                            <th class="text-center">YEAR</th>
                            <th class="text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody id="offenseTableBody">
                        <?php
                        if (!empty($students)) {
                            foreach ($students as $student) {
                                ?>
                                <tr>
                                    <td class="text-center"><?= htmlspecialchars($student['student_id']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($student['first_name']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($student['middle_name']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($student['surname']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($student['program']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($student['section']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($student['major']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($student['sms_email']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($student['year_level']); ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-primary btn-sm" onclick="populateModal(<?= htmlspecialchars(json_encode($student)); ?>)">Add Case</button>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='10' class='text-center'>No records found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- REGISTER OFFENSE Modal -->
<div class="modal" id="addCaseModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">REGISTER OFFENSE</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body" style="background-image: linear-gradient( #ccffff, #e6ffe6, #ffffcc);">
                <form action="code.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Student Details -->
                        <div class="col-md-6">
                            <label for="student_id">STUDENT NUMBER</label>
                            <input type="number" name="student_id" id="student_id" class="form-control" required readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="first_name">FIRST NAME</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" required readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="middle_name">MIDDLE NAME</label>
                            <input type="text" name="middle_name" id="middle_name" class="form-control" required readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="surname">SURNAME</label>
                            <input type="text" name="surname" id="surname" class="form-control" required readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="program">PROGRAM</label>
                            <input type="text" name="program" id="program" class="form-control" required readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="section">SECTION</label>
                            <input type="text" name="section" id="section" class="form-control" required readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="major">MAJOR</label>
                            <input type="text" name="major" id="major" class="form-control" required readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="sms_email">EMAIL</label>
                            <input type="email" name="sms_email" id="sms_email" class="form-control" required readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="year_level">YEAR</label>
                            <input type="text" name="year_level" id="year_level" class="form-control" required readonly>
                        </div>
                        
                        <!-- Offense Type -->
                        <div class="col-md-6">
                            <label for="offense_type">OFFENSE TYPE</label>
                            <select name="offense_type" id="offense_type" class="form-control" required onchange="updateOffenseOptions()">
                                <option value="" disabled selected>Select Offense Type</option>
                                <option value="Minor">Minor</option>
                                <option value="Major">Major</option>
                                <option value="Grave">Grave</option>
                            </select>
                        </div>
                        
                        <!-- Case Details -->
                        <div class="col-md-12">
                            <label for="statement">STATEMENT</label>
                            <textarea name="statement" class="form-control" placeholder="Enter Statement" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="case_id">CASE ID</label>
                            <input type="text" name="case_id" id="case_id" class="form-control" required>
                        </div>
                        <div class="col-md-12 mt-2">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="add_category_btn">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php');?>

<script>
function populateModal(data) {
    // Pre-fill the student information
    document.getElementById('student_id').value = data.student_id;
    document.getElementById('first_name').value = data.first_name;
    document.getElementById('middle_name').value = data.middle_name;
    document.getElementById('surname').value = data.surname;
    document.getElementById('program').value = data.program;
    document.getElementById('section').value = data.section;
    document.getElementById('major').value = data.major;
    document.getElementById('sms_email').value = data.sms_email;
    document.getElementById('year_level').value = data.year_level;

    // Generate case ID with 4 random digits
    var case_id = 'CASE-' + Math.floor(Math.random() * 9000) + 1000; // Generates something like CASE-1234
    document.getElementById('case_id').value = case_id;

    // Show the modal
    new bootstrap.Modal(document.getElementById('addCaseModal')).show();
}
</script>
