<?php 
include('includes/header.php');
include('../middleware/adminMiddleware.php');

$data = null; 

if (isset($_GET['id'])) {
    $category_id = mysqli_real_escape_string($con, $_GET['id']);

    $query = "SELECT * FROM categories WHERE id='$category_id'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_array($result);
    } else {
        echo "<div class='alert alert-danger'>CASE NOT FOUND</div>";
        exit;
    }
} else {
    echo "<div class='alert alert-danger'>ID MISSING FROM URL</div>";
    exit;
}

$historyQuery = "SELECT * FROM categories WHERE student_id = '" . mysqli_real_escape_string($con, $data['student_id']) . "' AND id != '$category_id'";
$historyResult = mysqli_query($con, $historyQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Case Details and AI Case Generator</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <div class="container-fluid p-4 bg-light text-dark text-center">
    <h1>View Case Details</h1>
  </div>

  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12 p-4 shadow">
        <div class="card">
          <div class="card-header bg-primary text-white">
            <h4>Case Details</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered">
                <tr><th>STUDENT NUMBER</th><td><?= htmlspecialchars($data['student_id']); ?></td></tr>
                <tr><th>FIRST NAME</th><td><?= htmlspecialchars($data['first_name']); ?></td></tr>
                <tr><th>SURNAME</th><td><?= htmlspecialchars($data['surname']); ?></td></tr>
                <tr><th>PROGRAM</th><td><?= htmlspecialchars($data['program']); ?></td></tr>
                <tr><th>SECTION</th><td><?= htmlspecialchars($data['section']); ?></td></tr>
                <tr><th>MAJOR</th><td><?= htmlspecialchars($data['major']); ?></td></tr>
                <tr><th>EMAIL</th><td><?= htmlspecialchars($data['sms_email']); ?></td></tr>
                <tr><th>YEAR LEVEL</th><td><?= htmlspecialchars($data['year_level']); ?></td></tr>
                <tr><th>CASE ID</th><td><?= htmlspecialchars($data['case_id']); ?></td></tr>
                <tr><th>OFFENSE TYPE</th><td><?= htmlspecialchars($data['offense_type']); ?></td></tr>
                <tr><th>OFFENSE ID</th><td><?= htmlspecialchars($data['offense_id']); ?></td></tr>
                <tr><th>SANCTION</th><td><?= htmlspecialchars($data['sanction']); ?></td></tr>
                <tr><th>COMPLETION DATE</th><td><?= htmlspecialchars($data['completion_date']); ?></td></tr>
                <tr><th>WARNING STAGE</th><td><?= htmlspecialchars($data['warning']); ?></td></tr> <!-- Added the warning stage -->
              </table>
            </div>

            <!-- AI Case Generator Section -->
            <hr>
            <h2>AI Case Generator</h2>

            <!-- Button to trigger the AI response generation -->
            <button class="btn btn-primary mt-3" onclick="generateResponse()">Generate AI Response</button>

            <!-- Loading Spinner -->
            <div id="loadingSpinner" class="text-center mt-4" style="display: none;">
              <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
              <p>Processing...</p>
            </div>

            <!-- AI Case Analysis Output -->
            <div id="aiCaseAnalysis" class="alert alert-info mt-4" role="alert">
              <!-- AI-generated content will appear here -->
              Your case analysis will appear here after generating a response.
            </div>

            <br>
            <a href="category.php" class="btn btn-secondary">Back to Cases</a>
            
            <!-- Warning History Section -->
            <hr>
            <h3>Offense History</h3>
            <?php if (mysqli_num_rows($historyResult) > 0): ?>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Case ID</th>
                    <th>Offense Type</th>
                    <th>Sanction</th>
                    <th>Completion Date</th>
                    <th>Warning Stage</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($history = mysqli_fetch_array($historyResult)): ?>
                    <tr>
                      <td><?= htmlspecialchars($history['case_id']); ?></td>
                      <td><?= htmlspecialchars($history['offense_type']); ?></td>
                      <td><?= htmlspecialchars($history['sanction']); ?></td>
                      <td><?= htmlspecialchars($history['completion_date']); ?></td>
                      <td><?= htmlspecialchars($history['warning']); ?></td> <!-- Added warning stage for past cases -->
                    </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
            <?php else: ?>
              <p>No previous warning history found for this student.</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include('includes/footer.php'); ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function generateResponse() {
      var studentData = {
        student_id: "<?= $data['student_id']; ?>",
        first_name: "<?= $data['first_name']; ?>",
        surname: "<?= $data['surname']; ?>",
        program: "<?= $data['program']; ?>",
        section: "<?= $data['section']; ?>",
        major: "<?= $data['major']; ?>",
        email: "<?= $data['sms_email']; ?>",
        year_level: "<?= $data['year_level']; ?>",
        case_id: "<?= $data['case_id']; ?>",
        offense_type: "<?= $data['offense_type']; ?>",
        offense_id: "<?= $data['offense_id']; ?>",
        sanction: "<?= $data['sanction']; ?>",
        completion_date: "<?= $data['completion_date']; ?>",
        statement: "<?= $data['statement']; ?>",
        date_meeting: "<?= $data['date_meeting']; ?>",
        attendees: "<?= $data['attendees']; ?>",
        parent_name: "<?= $data['parent_name']; ?>",
        parent_contact: "<?= $data['parent_contact']; ?>",
        conclusions: "<?= $data['conclusions']; ?>",
        case_status: "<?= $data['case_status']; ?>",
        warning: "<?= $data['warning']; ?>"  // Added warning stage data to AI generator
      };

      // Show loading spinner
      document.getElementById("loadingSpinner").style.display = "block";
      document.getElementById("aiCaseAnalysis").style.display = "none";

      // Send request to response.php
      fetch("response.php", {
        method: "POST",
        body: JSON.stringify({ studentData: studentData }),
        headers: { "Content-Type": "application/json" }
      })
      .then(response => response.text())
      .then(data => {
        document.getElementById("loadingSpinner").style.display = "none"; // Hide the loading spinner
        document.getElementById("aiCaseAnalysis").style.display = "block"; // Show the analysis
        document.getElementById("aiCaseAnalysis").innerHTML = data; // Display the result
      })
      .catch(error => {
        document.getElementById("loadingSpinner").style.display = "none";
        document.getElementById("aiCaseAnalysis").style.display = "block";
        document.getElementById("aiCaseAnalysis").innerHTML = "An error occurred while generating the case analysis.";
        console.error(error);
      });
    }
  </script>
</body>
</html>
