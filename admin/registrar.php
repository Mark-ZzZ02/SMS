<?php  
include('includes/header.php');
include('../middleware/adminMiddleware.php');
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 p-4 shadow rounded bg-light" style="background-image: linear-gradient( #ccffff, #e6ffe6, #ffffcc);">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>ADD STUDENT CASE MANUALLY</h4>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCaseModal">Add New Case</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Case Modal -->
<div class="modal" id="addCaseModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">ADD CASE</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body" style="background-image: linear-gradient( #ccffff, #e6ffe6, #ffffcc);">
                <form action="code.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Editable Student Details -->
                        <div class="col-md-6">
                            <label for="student_id">STUDENT NUMBER</label>
                            <input type="number" name="student_id" id="student_id" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="first_name">FIRST NAME</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="middle_name">MIDDLE NAME</label>
                            <input type="text" name="middle_name" id="middle_name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="surname">SURNAME</label>
                            <input type="text" name="surname" id="surname" class="form-control" required>
                        </div>
                       <!-- Program Dropdown (College & SHS) -->
                      <div class="col-md-6">
                          <label for="program">PROGRAM</label>
                          <select name="program" id="program" class="form-control" required>
                              <option value="" disabled selected>Select Program</option>
                              <optgroup label="College">
                                  <option value="BS Information Technology">BS Information Technology</option>
                                  <option value="BS Hospitality Management">BS Hospitality Management</option>
                                  <option value="BS Office Administration">BS Office Administration</option>
                                  <option value="BS Business Administration">BS Business Administration</option>
                                  <option value="BS Criminology">BS Criminology</option>
                                  <option value="Bachelor of Elementary Education">Bachelor of Elementary Education</option>
                                  <option value="Bachelor of Secondary Education">Bachelor of Secondary Education</option>
                                  <option value="BS Computer Engineering">BS Computer Engineering</option>
                                  <option value="BS Tourism Management">BS Tourism Management</option>
                                  <option value="BS Entrepreneurship">BS Entrepreneurship</option>
                                  <option value="BS Accounting Information System">BS Accounting Information System</option>
                                  <option value="BS Psychology">BS Psychology</option>
                                  <option value="BL Information Science">BL Information Science</option>
                              </optgroup>
                              <optgroup label="Senior High School">
                                  <option value="General Academic Strand">General Academic Strand</option>
                                  <option value="Accountancy Business and Management">Accountancy Business and Management</option>
                                  <option value="Humanities and Social Sciences">Humanities and Social Sciences</option>
                                  <option value="Science, Technology Engineering and Mathematics">Science, Technology Engineering and Mathematics</option>
                                  <option value="Information and Computer Technology">Information and Computer Technology</option>
                                  <option value="Performing Arts">Performing Arts</option>
                                  <option value="Home Economics">Home Economics</option>
                                  <option value="Industrial Arts">Industrial Arts</option>
                              </optgroup>
                          </select>
                      </div>
                        <div class="col-md-6">
                            <label for="section">SECTION</label>
                            <input type="text" name="section" id="section" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="major">MAJOR</label>
                            <input type="text" name="major" id="major" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="sms_email">EMAIL</label>
                            <input type="email" name="sms_email" id="sms_email" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="year_level">YEAR LEVEL</label>
                            <select name="year_level" id="year_level" class="form-control" required>
                                  <option value="" disabled selected>Select Year Level</option>
                                  <optgroup label="College">
                                      <option value="Freshmam(1st Year)">Freshmam(1st Year)</option>
                                      <option value="Sophomore(2nd Year)">Sophomore(2nd Year)</option>
                                      <option value="Junior(3rd Year)">Junior(3rd Year)</option>
                                      <option value="Senior(4th Year)">Senior(4th Year)</option>
                                  </optgroup>
                                  <optgroup label="Senior High School">
                                      <option value="Lower Senior High(Grade 11)">Lower Senior High(Grade 11)</option>
                                      <option value="Upper Senior High(Grade 12)">Upper Senior High(Grade 12)</option>
                                  </optgroup>
                            </select>
                        </div>                  
                        <!-- Offense Type -->
                        <div class="col-md-6">
                            <label for="offense_type">OFFENSE TYPE</label>
                            <select name="offense_type" id="offense_type" class="form-control" required>
                                <option value="" disabled selected>Select Offense Type</option>
                                <option value="Minor">Minor</option>
                                <option value="Major">Major</option>
                                <option value="Grave">Grave</option>
                            </select>
                        </div>

                        <!-- Case ID -->
                        <div class="col-md-6">
                            <label for="case_id">CASE ID</label>
                            <input type="text" name="case_id" id="case_id" class="form-control" required>
                        </div>

                        <!-- Statement -->
                        <div class="col-md-12">
                            <label for="statement">Typed Statement (optional if uploading an image)</label>
                            <textarea name="statement" class="form-control" placeholder="Enter statement if applicable"></textarea>
                        </div>

                        <div class="col-md-12">
                            <label for="statement_image">Upload Written Statement (Image)</label>
                            <input type="file" name="statement_image" id="statement_image" class="form-control" accept="image/*">
                        </div>

                        <div class="col-md-12">
                            <label for="medical_proof">Upload Medical Proof</label>
                            <input type="file" name="medical_proof" id="medical_proof" class="form-control" accept="image/*,application/pdf">
                        </div>

                        <div class="col-md-12">
                            <label for="evidence_image">Upload Other Evidence</label>
                            <input type="file" name="evidence_image" id="evidence_image" class="form-control" accept="image/*,application/pdf">
                        </div>

                        <!-- Submit -->
                        <div class="col-md-12 mt-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="add_category_btn">Save</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>



<?php include('includes/footer.php'); ?>

<script>
    // Automatically generate a random CASE ID when modal is shown
    const addCaseModal = document.getElementById('addCaseModal');
    addCaseModal.addEventListener('show.bs.modal', function () {
        const caseIdInput = document.getElementById('case_id');
        const randomId = 'CASE-' + Math.floor(Math.random() * 9000 + 1000);
        caseIdInput.value = randomId;
    });
</script>
