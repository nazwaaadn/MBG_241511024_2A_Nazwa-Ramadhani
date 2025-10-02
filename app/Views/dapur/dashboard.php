 <style>
   .card-title,
   .card-text {
     writing-mode: horizontal-tb !important;
     text-orientation: mixed !important;
     white-space: normal !important;
   }

   .card-body {
     display: block !important;
   }

   #tabs article {
     writing-mode: vertical-lr;
     /* atau */
     transform: rotate(90deg);
     /* atau */
     display: inline-block;
     width: auto;
   }

   .tabs-content article {
     writing-mode: horizontal-tb !important;
     transform: none !important;
     display: block !important;
     width: 100% !important;
   }

   .tabs-content article .card {
     display: block !important;
     width: 100% !important;
   }

   .tabs-content article .card-title,
   .tabs-content article .card-text {
     white-space: normal !important;
     writing-mode: horizontal-tb !important;
     text-orientation: mixed !important;
   }
 </style>

 <!-- Page Content -->
 <!-- Banner Starts Here -->
 <div class="main-banner header-text" id="top">
   <div class="Modern-Slider">
     <!-- Item -->
     <div class="item item-1">
       <div class="img-fill">
         <div class="text-content">
           <h4>Tambah data dapur<br>Made Simple</h4>
           <p>
             Aplikasi ini memudahkan dapur untuk melakukan proses permintaan data dapur
           </p>
         </div>
       </div>
     </div>
     <!-- // Item -->
   </div>
 </div>


 <div class="services mb-5">
   <div class="container">
     <div class="row justify-content-center">
       <div class="col-md-12">
       </div>

       <div class="col-md-5">
         <a href="<?= base_url('/addPermintaan') ?>">
           <div class="service-item justify-content-center">
             <div class="down-content">
               <center><img src="<?= base_url('image/inbox.png') ?>" alt="" srcset="" style="width: 50px; height: 50px; margin-bottom: 10px;"></center>
               <h4 class="mt-2">Tambah Permintaan</h4>
               <p>Pilih detail permintaan Bahan Baku Dapur yang ingin kamu ajukan. Pastikan sesuai dengan kebutuhanmu.</p>
             </div>
           </div>
         </a>
       </div>


       <div class="col-md-5">
         <a href="#mycourse">
           <div class="service-item">
             <div class="down-content">
               <center><img src="<?= base_url('image/learning.png') ?>" alt="" srcset="" style="width: 50px; height: 50px; margin-bottom: 10px;"></center>
               <h4 class="mt-2">Permintaan Saya</h4>
               <p>Lihat daftar permintaan yang kamu ajukan. Pantau statusnya untuk mengetahui perkembangannya.</p>
             </div>
           </div>
         </a>
       </div>

     </div>
   </div>
 </div>

 <section id="mycourse">
   <div class="services2">
     <div class="container">
       <div class="single-services mb-5">
         <div class="container">
           <div class="row">
             <div class="col-lg-12 mb-5 align-items-center">
               <center>
                 <h3>Daftar Permintaan</h3>
                 <p>Berikut adalah daftar Permintaan bahan baku dapur yang telah Anda Ajukan:</p>
               </center>
             </div>
             <div class="col-md-3">
               <div class="list-group" id="v-pills-tab" role="tablist">
                 <a class="list-group-item list-group-item-action active"
                   id="menunggu-tab"
                   data-bs-toggle="pill"
                   href="#menunggu"
                   role="tab"
                   aria-controls="menunggu"
                   aria-selected="true">
                   Status Menunggu <i class="fa fa-angle-right float-end"></i>
                 </a>
                 <a class="list-group-item list-group-item-action"
                   id="disetujui-tab"
                   data-bs-toggle="pill"
                   href="#disetujui"
                   role="tab"
                   aria-controls="disetujui"
                   aria-selected="false">
                   Permintaan Disetujui <i class="fa fa-angle-right float-end"></i>
                 </a>
                 <a class="list-group-item list-group-item-action"
                   id="ditolak-tab"
                   data-bs-toggle="pill"
                   href="#ditolak"
                   role="tab"
                   aria-controls="ditolak"
                   aria-selected="false">
                   Permintaan Ditolak <i class="fa fa-angle-right float-end"></i>
                 </a>
               </div>
             </div>


             <div class="col-md-9">
               <div class="tab-content" id="v-pills-tabContent">

                 <!-- MENUNGGU -->
<div class="tab-pane fade show active" id="menunggu" role="tabpanel" aria-labelledby="menunggu-tab">
  <div class="row">
    <?php foreach ($menunggu as $m): ?>
      <div class="col-md-4 mb-4">
        <div class="card h-100" style="border:1.5px solid #ffc107; border-radius:8px; box-shadow:0 4px 10px rgba(0,0,0,0.1);">
          <div class="card-body text-center">
            <!-- Icon Dapur -->
            <div class="mb-3">
              <i class="bi bi-egg-fried" style="font-size: 2.5rem; color:#ffc107;"></i>
            </div>

            <h5 class="card-title mb-3"><?= $m['menu_makan'] ?></h5>
            <h6 class="card-subtitle mb-3 text-muted"><?= date('d M Y', strtotime($m['tgl_masak'])) ?></h6>
            <p class="card-text mb-3">Lihat permintaan lebih detail</p>
            <a href="<?= base_url("/permintaandetail/" . $m['id']) ?>" class="btn btn-warning btn-sm px-3">Lihat Detail</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- DISETUJUI -->
<div class="tab-pane fade" id="disetujui" role="tabpanel" aria-labelledby="disetujui-tab">
  <div class="row">
    <?php foreach ($disetujui as $m): ?>
      <div class="col-md-4 mb-4">
        <div class="card h-100" style="border:1.5px solid #198754; border-radius:8px; box-shadow:0 4px 10px rgba(0,0,0,0.1);">
          <div class="card-body text-center">
            <!-- Icon Dapur -->
            <div class="mb-3">
              <i class="bi bi-egg-fried" style="font-size: 2.5rem; color:#198754;"></i>
            </div>

            <h5 class="card-title mb-3"><?= $m['menu_makan'] ?></h5>
            <h6 class="card-subtitle mb-3 text-muted"><?= date('d M Y', strtotime($m['tgl_masak'])) ?></h6>
            <p class="card-text mb-3">Lihat permintaan lebih detail</p>
            <a href="<?= base_url("/permintaandetail/" . $m['id']) ?>" class="btn btn-success btn-sm px-3">Lihat Detail</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- DITOLAK -->
<div class="tab-pane fade" id="ditolak" role="tabpanel" aria-labelledby="ditolak-tab">
  <div class="row">
    <?php foreach ($ditolak as $m): ?>
      <div class="col-md-4 mb-4">
        <div class="card h-100" style="border:1.5px solid #dc3545; border-radius:8px; box-shadow:0 4px 10px rgba(0,0,0,0.1);">
          <div class="card-body text-center">
            <!-- Icon Dapur -->
            <div class="mb-3">
              <i class="bi bi-egg-fried" style="font-size: 2.5rem; color:#dc3545;"></i>
            </div>

            <h5 class="card-title mb-3"><?= $m['menu_makan'] ?></h5>
            <h6 class="card-subtitle mb-3 text-muted"><?= date('d M Y', strtotime($m['tgl_masak'])) ?></h6>
            <p class="card-text mb-3">Lihat permintaan lebih detail</p>
            <a href="<?= base_url("/permintaandetail/" . $m['id']) ?>" class="btn btn-danger btn-sm px-3">Lihat Detail</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>


               </div>

             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
   </div>
 </section>