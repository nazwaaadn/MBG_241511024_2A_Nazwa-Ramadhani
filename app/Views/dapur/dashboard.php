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
              <img src="Student/assets/images/service_01.jpg" alt="">
              <div class="down-content">
                <center><img src="<?= base_url('image/inbox.png') ?>" alt="" srcset="" style="width: 50px; height: 50px; margin-bottom: 10px;"></center>
                <h4 class="mt-2">Add Permintaan</h4>
                <p>Tambah permintaan</p>

              </div>
            </div>
          </a>
        </div>


        <div class="col-md-5">
          <a href="#mycourse">
            <div class="service-item">
              <img src="Student/assets/images/service_02.jpg" alt="">
              <div class="down-content">
                <center><img src="<?= base_url('image/learning.png') ?>" alt="" srcset="" style="width: 50px; height: 50px; margin-bottom: 10px;"></center>
                <h4 class="mt-2">Lihat Permintaan</h4>
                <p>Lihat Permintaan anda</p>
                <br>
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
            <table class="table caption-top">
        <thead>
            <tr>
                <th scope="col">tanggal masak</th>
                <th scope="col">jumlah porsi</th>
                <th scope="col">menu makan</th>
                <th scope="col">status</th>
            </tr>
        </thead>
        <tbody id="result">
            <?php foreach ($BahanBaku as $bb): ?>
                <tr>
                    <td><?= $bb['tanggal_masak']; ?></td>
                    <td><?= $bb['jumlah_porsi']; ?></td>
                    <td><?= $bb['menu_makan']; ?></td>
                    <td><?= $bb['status']; ?></td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>

  