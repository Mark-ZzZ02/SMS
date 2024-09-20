</main>

  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/smooth-scrollbar.min.js"></script>


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

  </body>
</html>