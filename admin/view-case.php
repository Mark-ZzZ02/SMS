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

// Offense ID to Description Map
$offenseDescriptions = [
    // Minor Offenses
    "4.1.1.1" => "NOT WEARING OF SCHOOL ID CARD",
    "4.1.1.2" => "EATING INSIDE THE CLASSROOM, CHEWING BUBBLE GUMS, ETC.",
    "4.1.1.3" => "LOITERING NEAR THE GATE, STAYING OR SITTING NEAR FIRE ESCAPES, AND THE LIKE",
    "4.1.1.4" => "PUBLIC DISPLAY OF AFFECTION",
    "4.1.1.5" => "POSTING/ UNAUTHORIZED USED OF BANNERS",
    "4.1.1.6" => "SPITTING ON THE FLOOR, CORRIDORS, STAIRWAYS",
    "4.1.1.7" => "IMPROPER HAIRCUT, DYEING OF HAIR, WEARING OF EARRINGS",
    "4.1.1.8" => "ENTERING THE FACULTY RESTROOM, LOUNGES WITHOUT CONSENT",
    "4.1.1.9" => "MALE STUDENT ENTERING THE COMFORT ROOMS FOR FEMALES OR VICE VERSA",
    "4.1.1.10" => "UNHYGIENIC AND IMPROPER USE OF COLLEGE FACILITIES",
    "4.1.1.11" => "BRINGING IN OF POINTED OBJECTS",
    "4.1.1.12" => "REFUSAL TO SUBMIT ONESELF AND BELONGINGS FOR INSPECTION",
    "4.1.1.13" => "USING THE DIRTY FINGER SIGN OR VERY LEWD GESTURES",
    "4.1.1.14" => "CHARGING OF CELLPHONES, LAPTOPS AND OTHER GADGETS INSIDE CLASSROOMS",

    // Major Offenses
    "4.1.2.1" => "UNAUTHORIZED BRINGING OUT OF SCHOOL FACILITIES",
    "4.1.2.2" => "SMOKING WITHIN THE CAMPUS",
    "4.1.2.3" => "EXCESSIVE PUBLIC DISPLAY OF AFFECTION",
    "4.1.2.4" => "POSSESSION OF PORNOGRAPHIC MATERIALS",
    "4.1.2.5" => "VANDALISM OR DESTRUCTION OF SCHOOL PROPERTY",
    "4.1.2.6" => "ENTERING SCHOOL PREMISES UNDER THE INFLUENCE OF DRUGS",
    "4.1.2.7" => "UNAUTHORIZED OPERATION OF SCHOOL EQUIPMENT",
    "4.1.2.8" => "ACTS OF DISRESPECT TO ANY SCHOOL PERSONNEL",
    "4.1.2.9" => "ILLEGAL INTRUSION IN CLASSROOM",
    "4.1.2.10" => "USE OF SOCIAL MEDIA TO HARASS OR MALICIOUSLY ATTACK ANYONE",

    // Grave Offenses
    "4.1.3.1" => "POSSESSION, USE OR SALE OF PROHIBITED DRUGS",
    "4.1.3.2" => "THEFT OR EXTORTION",
    "4.1.3.3" => "POSSESSION OF DEADLY WEAPONS",
    "4.1.3.4" => "FRAUD OR CHEATING IN EXAMINATIONS",
    "4.1.3.5" => "SEXUAL HARASSMENT",
    "4.1.3.6" => "ENGAGING IN ANY FORM OF GAMBLING",
    "4.1.3.7" => "MALICIOUS AND UNAUTHORIZED DISCLOSURE OF STUDENT RECORDS",
    "4.1.3.8" => "ENGAGING IN ACTS OF DISORDERLINESS",
    "4.1.3.9" => "UNAUTHORIZED ENTRY INTO RESTRICTED AREAS",
    "4.1.3.10" => "COMMITTING ACTS OF TERRORISM",
    "4.1.3.11" => "ENGAGING IN PROSTITUTION",
    "4.1.3.12" => "COMMITTING ACTS OF VANDALISM"
];

$historyQuery = "SELECT * FROM categories WHERE student_id = '" . mysqli_real_escape_string($con, $data['student_id']) . "' AND id != '$category_id'";
$historyResult = mysqli_query($con, $historyQuery);

// Helper function
function formatOffense($id, $map) {
    return isset($map[$id]) ? "$id - {$map[$id]}" : $id;
}
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
                <tr><th>OFFENSE ID</th><td><?= htmlspecialchars(formatOffense($data['offense_id'], $offenseDescriptions)); ?></td></tr>
                <tr><th>SANCTION</th><td><?= htmlspecialchars($data['sanction']); ?></td></tr>
                <tr><th>COMPLETION DATE</th><td><?= htmlspecialchars($data['completion_date']); ?></td></tr>
                <tr><th>WARNING STAGE</th><td><?= htmlspecialchars($data['warning']); ?></td></tr>
              </table>
            </div>

            <!-- AI Case Generator Section -->
            <hr>
            <h2>AI Case Generator</h2>

            <button class="btn btn-primary mt-3" onclick="generateResponse()">Generate AI Response</button>

            <div id="loadingSpinner" class="text-center mt-4" style="display: none;">
              <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
              <p>Processing...</p>
            </div>

            <div id="aiCaseAnalysis" class="alert alert-info mt-4" role="alert">
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
                    <th>Offense ID</th>
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
                      <td><?= htmlspecialchars(formatOffense($history['offense_id'], $offenseDescriptions)); ?></td>
                      <td><?= htmlspecialchars($history['sanction']); ?></td>
                      <td><?= htmlspecialchars($history['completion_date']); ?></td>
                      <td><?= htmlspecialchars($history['warning']); ?></td>
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
        warning: "<?= $data['warning']; ?>"
      };

      document.getElementById("loadingSpinner").style.display = "block";
      document.getElementById("aiCaseAnalysis").style.display = "none";

      fetch("response.php", {
        method: "POST",
        body: JSON.stringify({ studentData: studentData }),
        headers: { "Content-Type": "application/json" }
      })
      .then(response => response.text())
      .then(data => {
        document.getElementById("loadingSpinner").style.display = "none";
        document.getElementById("aiCaseAnalysis").style.display = "block";
        document.getElementById("aiCaseAnalysis").innerHTML = data;
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
