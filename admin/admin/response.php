<?php
require "../vendor/autoload.php";

use GeminiAPI\Client;
use GeminiAPI\Resources\Parts\TextPart;

// Get the POST data (student data from the frontend)
$data = json_decode(file_get_contents("php://input"));
$studentData = $data->studentData;

// Create a structured analysis based on the student data
$studentNumber = htmlspecialchars($studentData->student_id);
$firstName = htmlspecialchars($studentData->first_name);
$surname = htmlspecialchars($studentData->surname);
$program = htmlspecialchars($studentData->program);
$section = htmlspecialchars($studentData->section);
$major = htmlspecialchars($studentData->major);
$email = htmlspecialchars($studentData->email);
$yearLevel = htmlspecialchars($studentData->year_level);
$caseID = htmlspecialchars($studentData->case_id);
$offenseType = htmlspecialchars($studentData->offense_type);
$offenseID = htmlspecialchars($studentData->offense_id);
$sanction = htmlspecialchars($studentData->sanction);
$completionDate = htmlspecialchars($studentData->completion_date);
$statement = htmlspecialchars($studentData->statement);
$dateMeeting = htmlspecialchars($studentData->date_meeting);
$attendees = htmlspecialchars($studentData->attendees);
$parentName = htmlspecialchars($studentData->parent_name);
$parentContact = htmlspecialchars($studentData->parent_contact);
$conclusions = htmlspecialchars($studentData->conclusions);
$status = htmlspecialchars($studentData->case_status);

// Adjusted sections based on Offense Type

// Incident Overview for different offense types
switch($offenseType) {
    case 'Minor':
        $incidentOverview = "The student, $firstName $surname, was involved in a minor offense. This could be a slight breach of rules, such as late submission of assignments or minor behavioral issues.";
        $findings = "The case was determined to be of a minor nature, with no major harm caused. The student has shown understanding of the mistake.";
        break;
    case 'Major':
        $incidentOverview = "The student, $firstName $surname, committed a major offense, which could include cheating on exams, plagiarism, or other significant academic violations.";
        $findings = "This offense was serious and suggests a pattern of behavior that needs correction. However, it was not of a criminal nature.";
        break;
    case 'Grave':
        $incidentOverview = "The student, $firstName $surname, was involved in a grave offense. This could include serious academic dishonesty, such as falsifying records or participating in illegal activities.";
        $findings = "The case is of a grave nature, with substantial repercussions for both the student and the institution. Immediate action is required to prevent recurrence.";
        break;
    default:
        $incidentOverview = "The offense details are unclear, and further investigation is required.";
        $findings = "The case requires additional investigation to determine the level of severity.";
        break;
}

// Possible conclusions based on offense type
$conclusionsArray = [
    'Minor' => [
        "The student acknowledged the minor offense and expressed remorse, promising to be more careful in the future.",
        "The student showed understanding of the issue and committed to avoiding similar behavior.",
        "Given the minor nature of the offense, the student’s actions appear to be an isolated incident.",
        "The student has expressed regret and is committed to ensuring this does not happen again.",
        "A mild reprimand should be sufficient given the nature of the violation.",
        "The student is likely to avoid such issues in the future, given their response.",
        "There is no indication that this is part of a recurring issue for the student.",
        "The student has learned from this minor incident and is unlikely to repeat it.",
        "The student has been warned and will be under observation for future compliance.",
        "Given the lack of severe consequences, the student is expected to improve going forward.",
        "The student is a first-time offender and should be given a chance to correct their behavior.",
        "The violation was unintentional, and no further action is required after the warning.",
        "The student's actions do not reflect a habitual violation of rules, and no severe sanction is needed.",
        "The incident was a misunderstanding, and it is unlikely to happen again.",
        "This minor offense serves as a reminder for the student to adhere to the institution’s guidelines.",
        "The student’s response was positive, and they have pledged to avoid similar issues in the future.",
        "The offense was handled swiftly, and the student has agreed to follow up with an improvement plan.",
        "Given the context, a formal warning is adequate, and the student will be monitored for further infractions.",
        "The incident was trivial and should not affect the student’s academic progress."
    ],
    'Major' => [
        "The student acknowledged the severity of the offense but requires more oversight to prevent future violations.",
        "The student has shown remorse but must undergo further corrective actions to address the major violation.",
        "This offense requires a more thorough corrective plan to ensure compliance with academic integrity policies.",
        "The student's actions were deliberate, but they have committed to rectifying their behavior moving forward.",
        "The case should be resolved with a more stringent follow-up, ensuring that the student learns from this violation.",
        "The student recognizes the severity of their actions but may need academic counseling to ensure compliance.",
        "The student's conduct is concerning, and it is recommended that they be placed under academic probation.",
        "The student must show improved behavior before they can fully return to normal academic standing.",
        "The student is genuinely remorseful, but the consequences of their actions are significant enough to warrant close monitoring.",
        "The severity of this offense indicates the need for a more substantial penalty or intervention.",
        "The student has promised to avoid similar actions, but they should be observed closely going forward.",
        "The major nature of the violation means that the student must commit to an action plan for improvement.",
        "This incident may reflect a pattern of behavior, and further interventions are needed.",
        "The student's behavior was not acceptable, but they have agreed to abide by all sanctions imposed.",
        "Further disciplinary action may be necessary to ensure the student fully understands the consequences of their actions.",
        "The student needs guidance to prevent future violations, and their academic future may depend on their adherence to sanctions.",
        "The student may benefit from additional counseling sessions to reinforce academic integrity.",
        "This case highlights the need for further attention to prevent recurrence, including more stringent academic supervision.",
        "The student is likely to improve, but they must demonstrate real change and commitment to the process."
    ],
    'Grave' => [
        "The student displayed minimal remorse, and further intervention is necessary to address serious academic misconduct.",
        "Due to the grave nature of the offense, the student must demonstrate clear commitment to change before being allowed to resume normal academic activity.",
        "The student’s actions are considered severe, and a comprehensive corrective strategy is required to reintegrate them into the academic community.",
        "The students behavior is concerning enough to warrant permanent removal from the academic program, pending further investigation.",
        "Given the gravity of the situation, the student must undergo rigorous rehabilitation and review before returning to academic life.",
        "The student's actions have damaged their reputation, and a clear path to rehabilitation is necessary for their return.",
        "This incident requires swift and severe action to prevent further harm to the institution’s reputation and the academic community.",
        "The student's actions have severe consequences, and they should face significant penalties and remedial actions.",
        "The student must be suspended for a period of time while a full review of their case is conducted.",
        "Given the seriousness of the violation, a probationary period with intensive oversight should be implemented.",
        "The student's actions undermine the integrity of the institution, and severe sanctions are required to restore trust.",
        "A thorough investigation is recommended to determine whether the student can continue in the academic program.",
        "Immediate suspension and removal from the program are recommended as part of the necessary disciplinary action.",
        "The student must complete a series of ethics courses and undergo a lengthy probationary period to regain trust.",
        "The student’s actions suggest a pattern of serious disregard for the rules, requiring comprehensive corrective actions.",
        "The seriousness of the violation calls for the imposition of both academic and behavioral sanctions.",
        "The student may face expulsion if they fail to demonstrate significant remorse and a commitment to rectifying their actions.",
        "A comprehensive review of the student’s future eligibility for academic participation is necessary.",
        "The gravity of this offense requires careful monitoring and the implementation of strict future academic guidelines."
    ]
];

// Define recommendations array
$recommendationsArray = [
    'Minor' => [
        "The student should receive a warning and be reminded of institutional policies.",
        "The student is advised to attend a seminar on time management.",
        "The student should ensure better planning to avoid minor breaches in the future.",
        "It is recommended that the student receive guidance from a faculty member.",
        "The student should be monitored to ensure there is no repeat of the minor incident.",
        "The student should be encouraged to use campus resources for academic support.",
        "The student should receive an academic probation notice but remain enrolled.",
        "A formal apology to the affected party could help restore relationships.",
        "It is recommended that the student participates in a workshop on academic integrity.",
        "The student should be reminded of the importance of adhering to institutional guidelines."
    ],
    'Major' => [
        "The student must complete an academic integrity workshop and sign a formal agreement.",
        "A follow-up meeting should be scheduled to monitor the student’s progress.",
        "The student is recommended to engage in counseling to address underlying issues.",
        "The student should undertake additional academic work under supervision.",
        "The student should receive a formal academic probation and be reassigned to a mentor.",
        "The student should be required to submit a written apology to all involved parties.",
        "The student must be monitored during their academic work to ensure compliance.",
        "The student should consider enrolling in a remedial ethics course.",
        "The student should serve a probationary period before being allowed full academic privileges.",
        "The student should be required to undergo behavioral and academic counseling."
    ],
    'Grave' => [
        "The student should undergo a full behavioral review and ethics training.",
        "The student should be suspended for a period of time pending review of their case.",
        "The student should consider academic suspension or expulsion, depending on their response.",
        "A full investigation into the student's academic history and future eligibility is necessary.",
        "The student should not be allowed to return to academic activities until further review.",
        "The student must undergo counseling and rehabilitation before resuming academic work.",
        "The student must be monitored closely during any re-entry into the academic program.",
        "A full review of the student’s academic standing and behavior is recommended before any reinstatement.",
        "The student should face severe academic consequences, including suspension or expulsion.",
        "The student's case requires a full institutional review, potentially leading to permanent removal from the program."
    ]
];

// Select random conclusion based on offense type
$randomConclusion = array_rand($conclusionsArray[$offenseType]);

// Select random recommendation based on offense type
$randomRecommendation = array_rand($recommendationsArray[$offenseType]);

// Output the structured analysis and selected recommendation
$analysis = <<<EOL
Student Case Analysis Report

Student Details:
Name: $firstName $surname
Student ID: $studentNumber
Program: $program
Year Level: $yearLevel
Major: $major
Section: $section
Email: $email

Case Information:
Case ID: $caseID
Offense Type: $offenseType
Offense ID: $offenseID
Statement: $statement
Incident Overview: $incidentOverview
Meeting Information:
Date of Meeting: $dateMeeting
Attendees: $attendees

Parent/Guardian Information:
Parent Name: $parentName
Parent Contact: $parentContact

Findings and Conclusions:
Conclusions: {$conclusionsArray[$offenseType][$randomConclusion]}

Sanction:
Sanction: $sanction

Final Status:
Status: $status

Recommendations for Future Action:
Recommendations: {$recommendationsArray[$offenseType][$randomRecommendation]}

Conclusion:
This student case analysis summarizes the key details of the disciplinary process concerning $firstName $surname. The offense was classified as $offenseType, with further investigation needed to understand the full context. The student is expected to comply with the sanctions imposed, and the case has been officially closed as of $completionDate.

Prefect Department
$completionDate
EOL;

// Return the generated analysis
echo nl2br($analysis);
?>
