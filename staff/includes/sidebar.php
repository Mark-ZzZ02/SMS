

<body>
<!-- Sidebar -->
<?php 
if(isset($_SESSION['auth'])) {
    $userName = $_SESSION['auth_user']['name'];
    $email = $_SESSION['auth_user']['email'];
?>
<div id="sidebar" class="sidebarr text-center shadow" style="background-color: #1E3A8A; color: #e0e0e0; font-family: Arial, sans-serif;">
<style>
    .nav-link {
        color: #e0e0e0; /* Default color */
        text-decoration: none; /* Remove underline */
        transition: color 0.3s; /* Smooth transition */
        display: flex; /* Make nav links a flex container */
        align-items: center; /* Center items vertically */
        min-width: 150px; /* Set a minimum width */
        white-space: nowrap; /* Prevent wrapping */
        overflow: hidden; /* Hide overflow */
        text-overflow: ellipsis; /* Add ellipsis for overflow text */
    }
    .nav-link:hover {
        color: white; /* Color on hover */
        background-color: rgba(255, 255, 255, 0.1); /* Optional: background color on hover */
    }
    .dropdown-content {
        display: none;
        background-color: #1E3A8A;
        padding: 10px 0;
        position: relative;
    }
    .dropdown:hover .dropdown-content {
        display: block;
    }
</style>

    <div class="p-3">
        <img src="./css/bcp_logo.png" alt="Logo" class="logo img-fluid mb-4" style="max-width: 100%; height: 200px;">
        <h4 class="mb-1" style="font-size: 1rem; color: #d3d3d3;"><?= htmlspecialchars($userName); ?></h4>
        <h4 class="mb-4" style="font-size: 1rem; color: #d3d3d3;"><?= htmlspecialchars($email); ?></h4>
        <ul class="nav flex-column">
            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center rounded" href="index.php">
                    <i class="fas fa-home" style="margin-right: 12px;"></i> SITE HOME
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center rounded" href="category.php">
                    <i class="fas fa-clipboard-list" style="margin-right: 12px;"></i> STUDENT TRACKING
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center rounded" href="parent.php">
                    <i class="fas fa-users" style="margin-right: 12px;"></i> PARENT MEETING
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center rounded" href="punishment.php">
                    <i class="fas fa-balance-scale" style="margin-right: 12px;"></i> PUNISHMENT
                </a>
            </li>
            <li class="nav-item mb-1 dropdown">
                <a class="nav-link d-flex align-items-center rounded" href="#" style="cursor: pointer;">
                    <i class="fas fa-check-circle" style="margin-right: 12px;"></i> APPROVAL
                </a>
                <div class="dropdown-content">
                    <a class="nav-link" href="faculty.php" style="color: #e0e0e0; padding: 5px 20px;">Faculty</a>
                </div>
            </li>
            <li class="nav-item mb-1 dropdown">
                <a class="nav-link d-flex align-items-center rounded" href="#" style="cursor: pointer;">
                    <i class="fas fa-file-alt" style="margin-right: 12px;"></i> REPORTS
                </a>
                <div class="dropdown-content">
                    <a class="nav-link" href="monthly_reports.php" style="color: #e0e0e0; padding: 5px 20px;">Monthly Reports</a>
                </div>
            </li>
        </ul>
    </div>
</div>
<?php
}
?>






<script>
document.addEventListener('DOMContentLoaded', function () {
    var sidebar = document.getElementById('sidebar');
    var content = document.getElementById('page-content');
    var toggleButton = document.getElementById('toggle-sidebar');

    toggleButton.addEventListener('click', function () {
        sidebar.classList.toggle('collapsed');
        content.classList.toggle('collapsed');
    });

    // Function to check screen width and close sidebar if necessary
    function checkScreenWidth() {
        if (window.innerWidth < 768) { // Adjust this value as needed
            sidebar.classList.add('collapsed');
            content.classList.add('collapsed');
        } else {
            sidebar.classList.remove('collapsed');
            content.classList.remove('collapsed');
        }
    }

    // Check on load
    checkScreenWidth();
    
    // Check on resize
    window.addEventListener('resize', checkScreenWidth);
});
</script>
