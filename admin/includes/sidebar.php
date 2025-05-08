<body style="background-image: linear-gradient( #ccffff, #e6ffe6, #ffffcc);">
<!-- Sidebar -->
<?php 
if(isset($_SESSION['auth'])) {
    $userName = $_SESSION['auth_user']['name'];
    $email = $_SESSION['auth_user']['email'];
    $currentPage = basename($_SERVER['PHP_SELF']);
?>
<div id="sidebar" class="sidebarr text-center shadow" style="background-image: linear-gradient(#212529, #213482); color: #e0e0e0; font-family: Arial, sans-serif;">
<style>
    .nav-link {
        color: white;
        text-decoration: none;
        transition: color 0.3s;
        display: flex;
        align-items: center;
        min-width: 150px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .nav-link:hover {
        color: white;
        background-color: rgba(255, 255, 255, 0.1);
    }
    .nav-link.active {
        color: #ffcc00;
    }

    .nav-header {
        color: #d3d3d3;
        font-size: 0.875rem; 
        font-weight: bold;
        padding: 10px 0;
        text-transform: uppercase;
        text-align: left; 
    }

    #sidebar {
        height: 100vh; 
        overflow-y: auto; 
    }

    .nav {
        padding-bottom: 50px; 
    }

    #sidebar::-webkit-scrollbar {
        width: 8px; 
    }

    #sidebar::-webkit-scrollbar-thumb {
        background-color: #888; 
        border-radius: 4px;
    }

    #sidebar::-webkit-scrollbar-thumb:hover {
        background-color: #555; 
    }

    .downbar {
        display: none; 
        background-color: #2c5282;
        padding: 10px;
        margin-top: 10px;
    }

    .downbar a {
        display: block;
        color: #e0e0e0;
        text-decoration: none;
        padding: 8px 16px;
    }

    .downbar a:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    .collapsed .downbar {
        display: block;
    }

    .collapsed #sidebar {
        overflow-y: auto; 
    }

    hr {
        width: 100%;
        height: 10px;
        background-color: #000;
        border: none;
        margin-top: none;
    }
</style>

    <div class="p-3">
        <img src="./css/pref.png" alt="Logo" class="logo img-fluid mb-4" style=" max-width: 100%; height: 200px; filter: drop-shadow(6px 6px 8px #00056e);">
        <hr />
        <div style="display: flex; align-items: center;">
            <img src="./css/admin.jpeg" style=" border-radius: 50%; max-width: 100%; height: 50px; filter: drop-shadow(3px 3px 4px #00056e);">
            <div style="margin-left: 10px;">
                <h4 class="mb-1" style="text-align: left; font-size: 1rem; color: white"><?= htmlspecialchars($userName); ?></h4>
                <h4 class="mb-1 " style="font-size: 1rem; color: white;"><?= htmlspecialchars($email); ?></h4>
            </div>
        </div>  
        <hr />
        <ul class="nav flex-column">
            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center rounded <?= $currentPage == 'index.php' ? 'active' : '' ?>" href="index.php">
                    <i class="fas fa-home" style="margin-right: 12px;"></i> DASHBOARD
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center rounded <?= $currentPage == 'registrar.php' ? 'active' : '' ?>" href="registrar.php">
                    <i class="fas fa-user-check" style="margin-right: 12px;"></i> REGISTER OFFENSE
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center rounded <?= $currentPage == 'category.php' ? 'active' : '' ?>" href="category.php">
                    <i class="fas fa-clipboard-list" style="margin-right: 12px;"></i> STUDENT TRACKING
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center rounded <?= $currentPage == 'parent.php' ? 'active' : '' ?>" href="parent.php">
                    <i class="fas fa-users" style="margin-right: 12px;"></i> PARENT MEETING
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center rounded <?= $currentPage == 'punishment.php' ? 'active' : '' ?>" href="punishment.php">
                    <i class="fas fa-balance-scale" style="margin-right: 12px;"></i> INVESTIGATION
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center rounded <?= $currentPage == 'reports.php' ? 'active' : '' ?>" href="reports.php">
                    <i class="fas fa-file-alt" style="margin-right: 12px;"></i> REPORTS
                </a>
            </li>
            <li class="nav-item mb-1 nav-header">INTEGRATIONS</li>
            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center rounded <?= $currentPage == 'guidance.php' ? 'active' : '' ?>" href="guidance.php">
                    <i class="fas fa-comments" style="margin-right: 12px;"></i> GUIDANCE
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center rounded <?= $currentPage == 'student_portal.php' ? 'active' : '' ?>" href="student_portal.php">
                    <i class="fas fa-user-graduate" style="margin-right: 12px;"></i> STUDENT PORTAL
                </a>
            </li>

            <li class="nav-item mb-1 nav-header">MAINTENANCE</li>
            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center rounded <?= $currentPage == 'users.php' ? 'active' : '' ?>" href="users.php">
                    <i class="fas fa-user-edit" style="margin-right: 12px;"></i> USER ACCOUNTS
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center rounded <?= $currentPage == 'trash_bin.php' ? 'active' : '' ?>" href="trash_bin.php">
                    <i class="fas fa-trash-alt" style="margin-right: 12px;"></i> ARCHIVE
                </a>
            </li>
        </ul>

        <div class="downbar">
            <a href="category.php">STUDENT TRACKING</a>
            <a href="parent.php">PARENT MEETING</a>
            <a href="punishment.php">INVESTIGATION</a>
            <a href="reports.php">REPORTS</a>
            <a href="registrar.php">REGISTRAR</a>
            <a href="faculty.php">Faculty</a>
            <a href="its.php">ITS</a>
            <a href="guidance.php">GUIDANCE</a>
            <a href="hr.php">HR</a>
            <a href="student_portal.php">STUDENT PORTAL</a>
            <a href="users.php">USER ACCOUNTS</a>
        </div>
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

    if (toggleButton) {
        toggleButton.addEventListener('click', function () {
            sidebar.classList.toggle('collapsed');
            if (content) content.classList.toggle('collapsed');
        });
    }

    function checkScreenWidth() {
        if (window.innerWidth < 768) {
            sidebar.classList.add('collapsed');
            if (content) content.classList.add('collapsed');
        } else {
            sidebar.classList.remove('collapsed');
            if (content) content.classList.remove('collapsed');
        }
    }

    checkScreenWidth();
    window.addEventListener('resize', checkScreenWidth);
});
</script>

</body>
