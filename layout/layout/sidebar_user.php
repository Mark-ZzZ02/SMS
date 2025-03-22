    <style>
        #sidebar {
            height: 100vh; /* Full height */
            width: 250px; /* Fixed width */
            position: fixed; /* Fixed position */
            top: 0;
            left: 0;
            background-color: #f8f9fa; /* Light background */
            transition: transform 0.3s ease; /* Smooth slide effect */
        }

        #sidebar.collapsed {
            transform: translateX(-100%); /* Hide sidebar */
        }

        #page-content {
            margin-left: 250px; /* Space for sidebar */
            transition: margin-left 0.3s ease; /* Smooth transition */
        }

        #page-content.collapsed {
            margin-left: 0; /* No margin when sidebar is hidden */
        }
    </style>
<head>
    <script src="./js/jquery/jquery.min.js"></script>
</head>
<body>
    <!-- Sidebar -->
    <div id="sidebar" class="bg-light text-center shadow">
        <div class="p-3">
        <img src="./css/bcp_logo.png" alt="Logo" class="logo">
            <h4 class="mb-4">Dashboard</h4>
            <ul class="nav flex-column">
                <li class="nav-item mb-1">
                    <a class="nav-link active border border-dark rounded" href="dashboard_user.php">Home</a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link border border-dark rounded" href="user_index.php">Student List</a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link border border-dark rounded" href="picture2.php">Pictures</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link border border-dark rounded text-danger" href="#" id="logout">Logout</a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Page Content -->
    <div id="page-content">
        <nav>
            <button class="btn shadow" type="button" id="toggle-sidebar">
                ☰ Menu
            </button>
        </nav>
        <div class="container-fluid">
            <h1 class="mt-4">Welcome to Social Media Department</h1>
            <p>Welcome User. <br> This is Social Media Department. <br> It is a system where you can add, edit, view, and update all data of Student's List you need. <br> You can also view the pictures of all gradutes here.</p>
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
    
</body>
</html>