<?php
require_once('../tcpdf/tcpdf.php');
include('../config/dbcon.php');

if (!isset($_GET['id'])) {
    die('ID is missing.');
}

$category_id = mysqli_real_escape_string($con, $_GET['id']);
$query = "SELECT * FROM categories WHERE id='$category_id'";
$result = mysqli_query($con, $query);
$data = mysqli_fetch_array($result);

if (!$data) {
    die('Case not found.');
}

// Offense Descriptions Map
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

// Get Offense History
$historyQuery = "SELECT * FROM categories WHERE student_id = '" . mysqli_real_escape_string($con, $data['student_id']) . "' AND id != '$category_id'";
$historyResult = mysqli_query($con, $historyQuery);

// Custom TCPDF Class with Header
class MYPDF extends TCPDF {
    public function Header() {
        $this->Image('css/bcp_logo.png', 15, 10, 20);
        $this->Image('css/pref.png', 175, 5, 29);
        $this->SetFont('helvetica', 'B', 14);
        $this->SetY($this->GetY() + 10);
        $this->Cell(0, 10, 'Bestlink College of the Philippines', 0, 1, 'C');
        $this->SetFont('helvetica', '', 11);
        $this->Cell(0, 5, 'Department of Prefect Discipline', 0, 1, 'C');
        $this->Ln(5);
    }
}

// Start PDF
$pdf = new MYPDF('P', 'mm', 'A4');
$pdf->SetMargins(15, 30, 15);
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 10);

// Page 1: Case Credentials & History
$html = <<<EOD
<style>
    h2 { text-align: center; font-size: 16pt; font-weight: bold; margin-bottom: 10px; }
    h3 { font-size: 12pt; font-weight: bold; margin-top: 15px; }
    table { border-collapse: collapse; width: 100%; }
    th {
        background-color: #f2f2f2;
        font-weight: bold;
        padding: 6px;
        border: 1px solid #000;
        text-align: left;
    }
    td {
        border: 1px solid #000;
        padding: 6px;
        vertical-align: top;
    }
    tr:nth-child(even) {
        background-color: #fcfcfc;
    }
</style>

<h2>Student Case Report</h2>
<h3>Case Credentials</h3>
<table>
EOD;

// Render case credentials rows
$rowCount = 0;
foreach ([ 
    'student_id' => 'Student Number',
    'first_name' => 'First Name',
    'surname' => 'Surname',
    'program' => 'Program',
    'section' => 'Section',
    'major' => 'Major',
    'sms_email' => 'Email',
    'year_level' => 'Year Level',
    'case_id' => 'Case ID',
    'offense_type' => 'Offense Type',
    'offense_id' => 'Offense ID',
    'sanction' => 'Sanction',
    'completion_date' => 'Completion Date',
    'warning' => 'Warning Stage'
] as $key => $label) {
    $rowClass = ($rowCount++ % 2 === 0) ? 'even' : 'odd';
    if ($key === 'offense_id') {
        $offenseCode = $data[$key];
        $value = $offenseCode . ' - ' . ($offenseDescriptions[$offenseCode] ?? 'Unknown Offense');
    } else {
        $value = htmlspecialchars($data[$key]);
    }
    $html .= "<tr class=\"$rowClass\"><td><b>$label</b></td><td>$value</td></tr>";
}

$html .= "</table>";

// Offense History Section
$html .= "<h3>Offense History</h3>";
if (mysqli_num_rows($historyResult) > 0) {
    $html .= "<table>
        <thead>
            <tr>
                <th>Case ID</th>
                <th>Offense Type</th>
                <th>Offense ID</th>
                <th>Sanction</th>
                <th>Completion Date</th>
                <th>Warning Stage</th>
            </tr>
        </thead><tbody>";
    $rowCount = 0;
    while ($row = mysqli_fetch_assoc($historyResult)) {
        $rowClass = ($rowCount++ % 2 === 0) ? 'even' : 'odd';
        $html .= "<tr class=\"$rowClass\">
            <td>{$row['case_id']}</td>
            <td>{$row['offense_type']}</td>
            <td>" . formatOffense($row['offense_id'], $offenseDescriptions) . "</td>
            <td>{$row['sanction']}</td>
            <td>{$row['completion_date']}</td>
            <td>{$row['warning']}</td>
        </tr>";
    }
    $html .= "</tbody></table>";
} else {
    $html .= "<p>No prior offenses found.</p>";
}


// AI Case Analysis
if (!empty($data['ai_analysis'])) {
    $html .= "<h3>AI Case Analysis</h3><p>" . nl2br(htmlspecialchars($data['ai_analysis'])) . "</p>";
}

$pdf->writeHTML($html, true, false, true, false, '');

// Helper for portrait image page
function addImagePage($pdf, $imgPath, $title) {
    if (!empty($imgPath) && file_exists("../uploads/$imgPath")) {
        $pdf->AddPage('P');
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->Cell(0, 10, $title, 0, 1, 'C');
        $pdf->Image("../uploads/$imgPath", 30, 40, 150, 200, '', '', '', false, 300, '', false, false, 1);
    }
}

// Image Pages
addImagePage($pdf, $data['statement_image'], 'Statement Image');
addImagePage($pdf, $data['medical_proof'], 'Medical Report');
addImagePage($pdf, $data['evidence_image'], 'Other Evidence');
addImagePage($pdf, $data['parent_meeting_photo'] ?? null, 'Parent Conference Photo');

// Output PDF
$pdf->Output("case_{$data['case_id']}.pdf", 'I');

// Helper: Format Offense Description
function formatOffense($id, $map) {
    return isset($map[$id]) ? "$id - {$map[$id]}" : $id;
}
?>
