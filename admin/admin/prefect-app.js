let studentsData = []; // Store fetched data globally for searching

// Function to get data from the MIS system (via API)
function getMisData() {
    $('#loading').show();  // Show loading indicator
    $.ajax({
        url: 'https://mis.schoolmanagementsystem2.com/mis_api.php', // MIS API URL
        method: 'GET',
        success: function(data) {
            try {
                studentsData = JSON.parse(data); // Store student data
                populateTable(studentsData); // Populate the table with student data
            } catch (e) {
                alert("Error processing the data from MIS system.");
            }
            $('#loading').hide();  // Hide loading indicator
        },
        error: function(err) {
            console.error("Error fetching data:", err);
            alert("Error fetching data from MIS system");
            $('#loading').hide();  // Hide loading indicator
        }
    });
}

// Function to populate the table with student data
function populateTable(students) {
    let table = $('#students-table tbody');
    table.empty(); // Clear existing data in the table

    if (students.length === 0) {
        table.append('<tr><td colspan="15">No records found</td></tr>');
    }

    students.forEach(student => {
        table.append(`
            <tr>
                <td>${student.id}</td>
                <td>${student.student_id}</td>
                <td>${escapeHtml(student.first_name)}</td>
                <td>${escapeHtml(student.middle_name)}</td>
                <td>${escapeHtml(student.surname)}</td>
                <td>${escapeHtml(student.program)}</td>
                <td>${escapeHtml(student.section)}</td>
                <td>${escapeHtml(student.major)}</td>
                <td>${escapeHtml(student.sms_email)}</td>
                <td>${escapeHtml(student.year_level)}</td>
         
            </tr>
        `);
    });
}

// Function to search for students by name or student ID
function searchData() {
    let searchTerm = $('#search-bar').val().toLowerCase().trim();

    if (searchTerm === '') {
        alert("Please enter a search term.");
        return;
    }

    let filteredStudents = studentsData.filter(student => {
        return student.first_name.toLowerCase().includes(searchTerm) || 
               student.last_name.toLowerCase().includes(searchTerm) || 
               student.student_id.toLowerCase().includes(searchTerm);
    });

    populateTable(filteredStudents);
}

// Sanitize HTML to prevent XSS attacks
function escapeHtml(unsafe) {
    return unsafe.replace(/[&<>"'`=\/]/g, function (char) {
        return `&#${char.charCodeAt(0)};`;
    });
}
