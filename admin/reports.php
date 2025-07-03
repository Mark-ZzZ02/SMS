<?php
include('includes/header.php');
include('../middleware/adminMiddleware.php');
include('../config/dbcon.php');

function validate($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Capture filter values
$month       = isset($_GET['month']) ? validate($_GET['month']) : '';
$year        = isset($_GET['year']) ? validate($_GET['year']) : '';
$case_status = isset($_GET['case_status']) ? validate($_GET['case_status']) : '';
$offense_type= isset($_GET['offense_type']) ? validate($_GET['offense_type']) : '';

// Build WHERE clause
$whereClauses = [];
if ($month)        $whereClauses[] = "MONTH(date_added) = '$month'";
if ($year)         $whereClauses[] = "YEAR(date_added) = '$year'";
if ($case_status)  $whereClauses[] = "case_status = '$case_status'";
if ($offense_type) $whereClauses[] = "offense_type = '$offense_type'";
$whereSQL = count($whereClauses) ? 'WHERE ' . implode(' AND ', $whereClauses) : '';

// Fetch records
$query = "SELECT * FROM categories $whereSQL ORDER BY id DESC";
$result = mysqli_query($con, $query);
?>

<div class="container mt-5">
  <div class="row">
    <div class="col-md-12 p-4 shadow rounded bg-light" style="background-image: linear-gradient(#ccffff, #e6ffe6, #ffffcc);">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>MONTHLY REPORTS</h4>
      </div>

      <form action="" method="GET" class="d-flex flex-wrap mb-3">
        <!-- Month Filter -->
        <div class="mb-2 me-2">
          <select name="month" class="form-select" style="min-width:150px;">
            <option value="">Select Month</option>
            <?php for ($m = 1; $m <= 12; $m++): ?>
              <option value="<?= $m ?>" <?= $m == $month ? 'selected' : '' ?>>
                <?= date('F', mktime(0,0,0,$m,1)) ?>
              </option>
            <?php endfor; ?>
          </select>
        </div>

        <!-- Year Filter -->
        <div class="mb-2 me-2">
          <select name="year" class="form-select" style="min-width:150px;">
            <option value="">Select Year</option>
            <?php for ($y = date('Y'); $y >= 2000; $y--): ?>
              <option value="<?= $y ?>" <?= $y == $year ? 'selected' : '' ?>><?= $y ?></option>
            <?php endfor; ?>
          </select>
        </div>

        <!-- Status Filter -->
        <div class="mb-2 me-2">
          <select name="case_status" class="form-select" style="min-width:150px;">
            <option value="">Select case status</option>
            <?php foreach (['Pending','Ongoing','Closed'] as $cs): ?>
              <option value="<?= $cs ?>" <?= $cs == $case_status ? 'selected' : '' ?>><?= $cs ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- Offense Type Filter -->
        <div class="mb-2 me-2">
          <select name="offense_type" class="form-select" style="min-width:150px;">
            <option value="">Select Offense Type</option>
            <?php foreach (['Minor','Major','Grave'] as $ot): ?>
              <option value="<?= $ot ?>" <?= $ot == $offense_type ? 'selected' : '' ?>><?= $ot ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- Buttons -->
        <div class="mb-2">
          <button type="submit" class="btn btn-primary">Filter</button>
        </div>
        <div class="mb-2 ms-2">
          <button class="btn btn-success" onclick="openExportWindow()">Export Excel</button>
        </div>
      </form>

      <!-- Results Table -->
      <div class="table-responsive">
        <table class="table table-striped table-hover mt-3 text-center">
          <thead>
            <tr>
              <th>STUDENT ID</th><th>SURNAME</th><th>FIRST NAME</th><th>PROGRAM</th>
              <th>SECTION</th><th>MAJOR</th><th>YEAR LEVEL</th><th>DATE</th>
              <th>CASE STATUS</th><th>OFFENSE TYPE</th><th>OFFENSE ID</th>
              <th>SANCTION</th><th>COMPLETION DATE</th>
            </tr>
          </thead>
          <tbody>
            <?php if (mysqli_num_rows($result)): ?>
              <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <?php
                  $badge = match($row['case_status']) {
                    'Pending' => 'badge bg-success',
                    'Ongoing' => 'badge bg-warning text-dark',
                    'Closed' => 'badge bg-danger',
                    default   => 'badge bg-secondary',
                  };
                ?>
                <tr>
                  <td><?= htmlspecialchars($row['student_id']) ?></td>
                  <td><?= htmlspecialchars($row['surname']) ?></td>
                  <td><?= htmlspecialchars($row['first_name']) ?></td>
                  <td><?= htmlspecialchars($row['program']) ?></td>
                  <td><?= htmlspecialchars($row['section']) ?></td>
                  <td><?= htmlspecialchars($row['major']) ?></td>
                  <td><?= htmlspecialchars($row['year_level']) ?></td>
                  <td><?= htmlspecialchars($row['date_added']) ?></td>
                  <td><span class="<?= $badge ?>"><?= htmlspecialchars($row['case_status']) ?></span></td>
                  <td><?= htmlspecialchars($row['offense_type']) ?></td>
                  <td><?= htmlspecialchars($row['offense_id']) ?></td>
                  <td><?= htmlspecialchars($row['sanction']) ?></td>
                  <td><?= htmlspecialchars($row['completion_date'] ?: 'N/A') ?></td>
                </tr>
              <?php endwhile; ?>
            <?php else: ?>
              <tr><td colspan="13">No records found</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include('includes/footer.php') ?>

<script>
function openExportWindow() {
  const qs = new URLSearchParams({
    month: document.querySelector('select[name="month"]').value,
    year: document.querySelector('select[name="year"]').value,
    case_status: document.querySelector('select[name="case_status"]').value,
    offense_type: document.querySelector('select[name="offense_type"]').value,
    filename: `Monthly_Report_${new Date().toISOString().slice(0,10)}`
  }).toString();
  window.open('generate_excel.php?' + qs, '_blank', 'width=1000,height=700');
}
</script>
