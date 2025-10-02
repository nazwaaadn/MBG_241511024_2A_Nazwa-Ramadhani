<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
  body {
    background-color: #f8f9fa;
    font-family: "Segoe UI", sans-serif;
  }

  .card {
    border: 1px solid #0d6efd;
    border-radius: 12px;
    margin-bottom: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
  }

  .card-header-custom {
    background-color: #ffffff;
    color: #000;
    font-weight: bold;
    font-size: 1.2rem;
    padding: 15px 20px;
    border-bottom: 1px solid #0d6efd;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .card-body {
    padding: 20px 25px;
  }

  .detail-item {
    margin-bottom: 15px;
  }

  .label {
    font-weight: 600;
    display: inline-block;
    width: 150px;
    color: #333;
  }

  .status {
    padding: 5px 12px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    text-transform: capitalize;
  }

  .status.tersedia { background-color: #d4edda; color: #155724; }
  .status.segera_kadaluarsa { background-color: #fff3cd; color: #856404; }
  .status.kadaluarsa { background-color: #f8d7da; color: #721c24; }

  

  .table-responsive { padding: 10px 0; }

  @media(max-width: 768px) {
    .row-cols {
      flex-direction: column;
    }
  }
</style>

<!-- Page Content -->
  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1>Detail Permintaan</h1>
        </div>
      </div>
    </div>
  </div>

<div class="container mt-5">
  <div class="row row-cols justify-content-center g-4">
    <!-- Card Permintaan -->
    <div class="col-md-5">
      <div class="card">
        <div class="card-header-custom">
          <i class="bi bi-card-list"></i> Detail Permintaan
        </div>
        <div class="card-body">
          <div class="detail-item"><span class="label">Pemohon:</span> <?= esc($permintaan['nama_pemohon']); ?></div>
          <div class="detail-item"><span class="label">Tanggal Masak:</span> <?= esc($permintaan['tgl_masak']); ?></div>
          <div class="detail-item"><span class="label">Menu Makan:</span> <?= esc($permintaan['menu_makan']); ?></div>
          <div class="detail-item"><span class="label">Jumlah Porsi:</span> <?= esc($permintaan['jumlah_porsi']); ?></div>
          <div class="detail-item"><span class="label">Status:</span> 
            <span class="status <?= $permintaan['status'] == 'menunggu' ? 'segera_kadaluarsa' : '' ?>">
              <?= ucfirst($permintaan['status']); ?>
            </span>
          </div>
        </div>
      </div>
    </div>

    <!-- Card Bahan Baku -->
    <div class="col-md-7">
      <div class="card">
        <div class="card-header-custom">
          <i class="bi bi-box-seam"></i> Bahan Baku
        </div>
        <div class="card-body">
          <table class="table table-hover mb-0">
            <thead>
              <tr>
                <th>Nama Bahan</th>
                <th>Kategori</th>
                <th>Jumlah Diminta</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($permintaan['bahan'] as $bahan): ?>
              <tr>
                <td><?= esc($bahan['nama']); ?></td>
                <td><?= esc($bahan['kategori']); ?></td>
                <td><?= esc($bahan['jumlah_diminta']); ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="text-center mt-4 mb-5">
    <a href="<?= base_url('/Permintaan') ?>" class="btn btn-secondary">
      <i class="bi bi-arrow-left"></i> Kembali
    </a>
  </div>
</div>
