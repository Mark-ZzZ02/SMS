

<body>
    <!-- Sidebar -->
    <!-- sidebar.php -->
<div id="sidebar" class="bg-light text-center shadow">
    <div class="p-3">
        <img src="./css/bcp_logo.png" alt="Logo" class="logo">
        <h4 class="mb-4">Dashboard</h4>
        <ul class="nav flex-column">
            <li class="nav-item mb-1">
                <a class="nav-link active rounded" href="index.php">SITE HOME</a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link rounded" href="category.php">STUDENT TRACKING</a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link rounded" href="punishment.php">SANCTIONS AND PUNISHMENT</a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link rounded" href="#">APPROVAL</a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link rounded" href="#">REPORTS</a>
            <li class="nav-item">
            <li class="nav-item mb-1">
                <a class="nav-link rounded" href="#">USER ACCOUNTS</a>
            <li class="nav-item">
                <a class="nav-link rounded text-danger" href="../logout.php" id="logout">Logout</a>
            </li>
        </ul>
    </div>
</div>

<script>
        document.addEventListener('DOMContentLoaded', function () {
            var sidebar = document.getElementById('sidebar');
            var content = document.getElementById('page-content');
            var toggleButton = document.getElementById('toggle-sidebar');

            toggleButton.addEventListener('click', function () {
                sidebar.classList.toggle('collapsed');
                content.classList.toggle('collapsed');
            });
        });
    </script>