<!DOCTYPE html>
<html lang="en">
<?= $this->include('layouts/head') ?>
<body>
    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
        <div></div>
        <div></div>
        <div></div>
        </div>
    </div>
    <!-- Navbar -->
    <?= $this->include('layouts/navbar') ?>

     <?= $content ?>

    <!-- Footer -->
    <?= $this->include('layouts/footer') ?>

    <!-- Bootstrap core JavaScript -->
  <script src="<?= base_url('Student/vendor/jquery/jquery.min.js') ?>"></script>
  <script src="<?= base_url('Student/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

  <!-- Additional Scripts -->
  <script src="<?= base_url('Student/assets/js/custom.js') ?>"></script>
  <script src="<?= base_url('Student/assets/js/owl.js') ?>"></script>
  <script src="<?= base_url('Student/assets/js/slick.js') ?>"></script>
  <script src="<?= base_url('Student/assets/js/accordions.js') ?>"></script>

  <script language="text/Javascript">
    cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
    function clearField(t) { //declaring the array outside of the
      if (!cleared[t.id]) { // function makes it static and global
        cleared[t.id] = 1; // you could use true and false, but that's more typing
        t.value = ''; // with more chance of typos
        t.style.color = '#fff';
      }
    }
  </script>

</body>
</html>
