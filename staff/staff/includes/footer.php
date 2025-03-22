
<footer>
<style>
        thead {
        background-color: #5DADE2;
    }
	</style>
</footer>
<link href="./css/style.css" rel="stylesheet">
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

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>


  <script>
  new DataTable('#example');
  </script>
