

<div id="page-content">
<nav>
    <nav style="background-image: linear-gradient( #ffffcc, #e6ffe6, #ccffff);">
    <div class="topnav d-flex align-items-center justify-content-between">
        <button class="btn" type="button" id="toggle-sidebar">
            <a class="active">☰</a>
        </button>
        <?php 
        if (isset($_SESSION['auth'])) {
        ?>
            <div class="d-flex align-items-center ms-auto">
                <a href="#" class="notification-icon">
                    <i class="fas fa-bell"></i> 
                </a>
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user-edit"></i> Profile
                            </a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="../logout.php">
                          <i class="fas fa-sign-out-alt"></i> Logout
                          </a>
                      </li>
                    </ul>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</nav>








<link href="./css/style.css" rel="stylesheet">