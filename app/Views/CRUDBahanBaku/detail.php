<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<style>
  body {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #f8f9fa;
  }
  .detail-card {
    width: 600px;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    border: 1px solid #0d6efd;
    background: #fff;
  }
  .detail-header {
    background-color: #0d6efd;
    color: white;
    border-radius: 10px 10px 0 0;
    padding: 15px;
    text-align: center;
  }
  .detail-body {
    padding: 20px;
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
  .status.tersedia {
    background-color: #d4edda;
    color: #155724;
  }
  .status.segera_kadaluarsa {
    background-color: #fff3cd;
    color: #856404;
  }
  .status.kadaluarsa {
    background-color: #f8d7da;
    color: #721c24;
  }
</style>

<div class="detail-card">
  <div class="detail-header">
    <h4><i class="bi bi-card-list"></i> Detail Permintaan</h4>
  </div>
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
      <span class="status <?= $permintaan['status'] == 'menunggu' ? 'segera_kadaluarsa' : '' ?>">
        <?= ucfirst($permintaan['status']); ?>
      </span>
    </div>

    <hr>

    <h5><i class="bi bi-box-seam"></i> Detail Bahan Baku</h5>
    <?php foreach($permintaan['bahan'] as $bahan): ?>
      <div class="detail-item">
        <span class="label">Nama Bahan:</span> <?= esc($bahan['nama']); ?>
      </div>
      <div class="detail-item">
        <span class="label">Kategori:</span> <?= esc($bahan['kategori']); ?>
      </div>
      <div class="detail-item">
        <span class="label">Jumlah Diminta:</span> <?= esc($bahan['jumlah_diminta']); ?>
      </div>
      <hr>
    <?php endforeach; ?>

    <div class="text-center mt-4">
      <a href="<?= base_url('/Permintaan') ?>" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
      </a>
    </div>
  </div>
</div>
