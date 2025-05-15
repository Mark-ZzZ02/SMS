

 <style>
  .navbar {
    background-color: #0d6efd;
    height: 4.5rem;
  }

  .navbar-nav .nav-item .nav-link,
  .navbar-nav .nav-item .btn {
    color: white !important;
    border: 2px solid transparent;
    border-radius: 10px;
    padding: 0.5rem 1rem;
    transition: all 0.3s ease-in-out;
  }

  .navbar-nav .nav-item .nav-link:hover,
  .navbar-nav .nav-item .btn:hover {
    border-color: white;
    background-color: rgba(255, 255, 255, 0.1);
  }

  /* Optional: Add a special style for the last nav item */
  .navbar-nav .nav-item:last-child .nav-link,
  .navbar-nav .nav-item:last-child .btn {
    border: white 2px solid;
    border-radius: 10px;
  }

  .mx-6 {
    padding: 2rem 8rem;
  }

</style>
<body>
  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container-fluid d-flex mx-5 justify-content-between flex-row">
      <div class="d-flex align-items-center">
        <img src="./css/pf.png" height="50" class="logo me-2">
        <a class="navbar-brand text-white" href="index.php">PREFECT MANAGEMENT SYSTEM</a>
      </div>
      <div>
        <ul class="navbar-nav flex-row gap-2">
          <li class="nav-item">
            <a class="btn" href="sample.php">Back</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</body>


