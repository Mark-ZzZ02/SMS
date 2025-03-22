function generateResponse() {
  var studentData = {
    student_id: document.getElementById('studentId').textContent,
    first_name: document.getElementById('firstName').textContent,
    surname: document.getElementById('surname').textContent,
    program: document.getElementById('program').textContent,
    section: document.getElementById('section').textContent,
    major: document.getElementById('major').textContent,
    email: document.getElementById('email').textContent,
    year_level: document.getElementById('yearLevel').textContent,
    case_id: document.getElementById('caseId').textContent,
    offense_type: document.getElementById('offenseType').textContent,
    offense_id: document.getElementById('offenseId').textContent,
    sanction: document.getElementById('sanction').textContent,
    completion_date: document.getElementById('completionDate').textContent,
    statement: document.getElementById('statement').textContent,
    date_meeting: document.getElementById('dateMeeting').textContent,
    attendees: document.getElementById('attendees').textContent,
    parent_name: document.getElementById('parentName').textContent,
    parent_contact: document.getElementById('parentContact').textContent,
    conclusions: document.getElementById('conclusions').textContent,
    case_status: document.getElementById('status').textContent,
  };

  document.getElementById("loadingSpinner").style.display = "block";
  document.getElementById("aiCaseAnalysis").style.display = "none"; 

  fetch("response.php", {
    method: "POST",
    body: JSON.stringify({ studentData: studentData }),
    headers: {
      "Content-Type": "application/json"
    }
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
