<!-- Header -->
  <div class="sub-header">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-xs-12">
          <ul class="left-info">
            <li><a href="#">Politeknik Negeri Bandung</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <header class="">
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="index.html">
          <h2>ALPENCOURSE</h2>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('/home') ?>">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('/addnewcourse') ?>">Courses</a>
            </li>
            <li class="nav-item">
              <form action="<?= base_url('/logout') ?>" method="POST" id="logoutForm">
                <button class="btn btn-danger" type="submit">Logout</button>
              </form>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

 <script>
     const form = document.getElementById('logoutForm');
     form.addEventListener('submit', function(event) {
         event.preventDefault(); // cegah submit default

         Swal.fire({
             title: 'Are you sure you want to logout?',
             icon: 'warning',
             showCancelButton: true,
             confirmButtonText: 'Yes, logout',
             cancelButtonText: 'Cancel'
         }).then((result) => {
             if (result.isConfirmed) {
                 form.submit(); // pakai variabel, bukan this
             }
         });
     });
 </script>

 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>