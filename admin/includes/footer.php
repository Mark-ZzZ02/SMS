
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

          .topnav {
              justify-content: space-between; /* Space between button and links */
              align-items: center; /* Align items vertically */
              background-color: #4338ca; /* Light background */
              padding: 10px;
    
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
              background-color: #04AA6D;
              color: white;
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
  </style>

</footer>