<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

<style>
  body {
    display: flex;
    justify-content: center;
    background-color: #f8f9fa;
    padding: 20px;
    font-family: 'Poppins', sans-serif;
  }
  .detail-card {
    display: flex;
    gap: 20px;
    width: 100%;
    max-width: 1200px;
  }
  .card-section {
  position: relative; /* biar anchor untuk icon */
  border-radius: 15px;
  margin-top: 30px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.2);
  border: 1px solid #0d6efd;
  background: #fff;
  overflow: visible; /* penting: biar icon boleh keluar */
}

.card-icon {
  position: absolute;
  top: -30px;  /* keluar dari card */
  left: 50%;   /* center horizontal */
  transform: translateX(-50%);
  width: 70px;
  height: 70px;
  border-radius: 50%;
  background-color: #ffffff;
  border: 1px solid #0d6efd;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #0d6efd;
  font-size: 28px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.2);
  z-index: 2;
}

.detail-header {
  margin-top: 40px; /* biar header turun dikit */
  color: #515151ff;
  padding: 25px 15px 2px;
  text-align: center;
  border-radius: 0 0 10px 10px;
}


  .detail-body {
    padding: 15px;
  }
  .detail-item {
    margin-bottom: 15px;
    padding: 5px;
  }
  .label {
    font-weight: bold;
    color: #3c3c3cff;
    display: inline-block;
    width: 180px;
  }
  .status {
    padding: 5px 10px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
  }
  .status.menunggu {
    background-color: #fff3cd;
    color: #856404;
  }
  .status.disetujui {
    background-color: #d4edda;
    color: #155724;
  }
  .status.ditolak {
    background-color: #f8d7da;
    color: #721c24;
  }
</style>

<div class="detail-card">

  <!-- Detail Permintaan -->
  <div class="card-section">
    <div class="card-icon">
      <i class="bi bi-card-list"></i>
    </div>
    <div class="detail-header">
      <h4>Detail Permintaan</h4>
    </div>
    <hr style="color:  #0d6efd;">
    <div class="detail-body">
      <div class="detail-item">
        <span class="label">Pemohon:</span> <?= esc($permintaan['nama_pemohon']); ?>
      </div>
      <div class="detail-item">
        <span class="label">Tanggal Masak:</span> <?= esc($permintaan['tgl_masak']); ?>
      </div>
      <div class="detail-item">
        <span class="label">Menu Makan:</span> <?= esc($permintaan['menu_makan']); ?>
      </div>
      <div class="detail-item">
        <span class="label">Jumlah Porsi:</span> <?= esc($permintaan['jumlah_porsi']); ?>
      </div>
      <div class="detail-item">
        <span class="label">Status Permintaan:</span> 
        <span class="status <?= $permintaan['status']; ?>">
          <?= ucfirst($permintaan['status']); ?>
        </span>
      </div>

      <div class="text-center mt-4">
        <a href="<?= base_url('/Permintaan/display') ?>" class="btn btn-secondary">
          <i class="bi bi-arrow-left"></i> Kembali
        </a>
      </div>
    </div>
  </div>

  <!-- Detail Bahan Baku -->
  <div class="card-section">
    <div class="card-icon">
      <i class="bi bi-box-seam"></i>
    </div>
    <div class="detail-header">
      <h4>Detail Bahan Baku</h4>
    </div>
    <hr style="color:  #0d6efd;">
    <div class="detail-body">
      <table class="table table-hover mb-0">
        <thead>
          <tr>
            <th>Nama Bahan</th>
            <th>Kategori</th>
            <th>Jumlah Diminta</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($detail as $bahan): ?>
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
