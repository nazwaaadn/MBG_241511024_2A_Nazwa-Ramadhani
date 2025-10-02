 <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
     <!-- Navbar Brand-->
     <a class="navbar-brand ps-3" href="<?= base_url('/index.php/gudang') ?>">Dashboard Admin</a>
     <!-- Sidebar Toggle-->
     <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
     <!-- Navbar Search-->
     <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
     </form>
     <!-- Navbar-->
     <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
         <li class="nav-item dropdown">
             <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
             <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                 <li class="dropdown-item">
                     <form action="<?= base_url('/logout') ?>" method="POST" id="logoutForm">
                         <button type="submit" class="btn btn-danger">Logout</button>
                     </form>
                     <!-- <a class="dropdown-item" href="<?= base_url('/logout') ?>">Logout</a> -->
                 </li>
             </ul>
         </li>
     </ul>
 </nav>

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