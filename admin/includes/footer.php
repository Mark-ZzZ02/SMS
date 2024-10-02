
<footer>
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

          .logo{
              
              width: 200px;
              height: 300px;
              object-fit: contain;
          }
          .nav-item { 
              text-align: left;
          }
          body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
          }

          .topnav a {
              padding: 14px 20px;
              text-decoration: none;
              color: black;
              font-size: 18px;
              align-items: right;
          }

          .topnav a:hover {
              background-color: #ddd;
              color: black;
          }

          .topnav a.active {

              color: black;
          }

          .topnav button {
              border: none;
              background: none;
          }
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

          .logo{
              
              width: 200px;
              height: 300px;
              object-fit: contain;
          }
          .nav-item { 
              text-align: left;
          }
          .container {
            max-width: none;          /* Remove maximum width constraint */
        }       
  </style>

</footer>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script>
<?php 
if(isset($_SESSION['message'])) 
  { 
	  ?>
	  alertify.set('notifier','position', 'top-right');
	  alertify.success('<?= $_SESSION['message'] ?>');
	  <?php 
	  unset($_SESSION['message']);
  }
?>
</script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

  <script>
  $(document).ready( function () {
    $('#table').DataTable();
  });
  </script>
