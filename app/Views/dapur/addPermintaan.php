<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .custom-card {
        box-shadow: 0 4px 18px rgba(0, 0, 255, 0.1);
        border-radius: 12px;
        margin-bottom: 20px;
    }

    .custom-card h2 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: bold;
    }

    .form-card {
        padding: 40px;
    }
</style>

<!-- Page Content -->
<div class="page-heading header-text">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Tambah Permintaan</h1>
            </div>
        </div>
    </div>
</div>

<!-- Card Form -->
<div class="card custom-card form-card" style="border-radius: 20px;">
    <div class="card-body p-4">
        <form action="<?= site_url('addPermintaan/store') ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="tgl_masak" class="form-label">Tanggal Masak</label>
                <input type="date" class="form-control <?= session('errors.tgl_masak') ? 'is-invalid' : '' ?>"
                    id="tgl_masak" name="tgl_masak" value="<?= old('tgl_masak') ?>">
                <?php if (session('errors.tgl_masak')): ?>
                    <div class="invalid-feedback"><?= session('errors.tgl_masak') ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="menu_makan" class="form-label">Menu yang akan dibuat</label>
                <input type="text" class="form-control <?= session('errors.menu_makan') ? 'is-invalid' : '' ?>"
                    id="menu_makan" name="menu_makan" placeholder="Masukkan menu" value="<?= old('menu_makan') ?>">
                <?php if (session('errors.menu_makan')): ?>
                    <div class="invalid-feedback"><?= session('errors.menu_makan') ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="jumlah_porsi" class="form-label">Jumlah Porsi</label>
                <input type="number" class="form-control <?= session('errors.jumlah_porsi') ? 'is-invalid' : '' ?>"
                    id="jumlah_porsi" name="jumlah_porsi" placeholder="Masukkan jumlah porsi" value="<?= old('jumlah_porsi') ?>">
                <?php if (session('errors.jumlah_porsi')): ?>
                    <div class="invalid-feedback"><?= session('errors.jumlah_porsi') ?></div>
                <?php endif; ?>
            </div>

            <hr>
            <h5>Daftar Bahan Baku</h5>
            <table class="table table-bordered mb-3" id="bahanTable">
                <thead>
                    <tr>
                        <th>Nama Bahan</th>
                        <th>Jumlah</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bahan-row">
                        <td>
                            <select name="bahan_nama[]" class="form-control">
                                <option value="">-- Pilih Bahan --</option>
                                <?php foreach ($bahan_baku as $b): ?>
                                    <option value="<?= $b['nama'] ?>"><?= $b['nama'] ?> (<?= $b['jumlah'] . ' ' . $b['satuan'] ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="bahan_jumlah[]" class="form-control" placeholder="Jumlah">
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-row">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <button type="button" class="btn btn-secondary mb-3" id="addBahan">Tambah Bahan</button>
            <button type="submit" class="btn btn-primary w-100">Submit</button>

            <script>
                const bahanData = `<?php
                                    // Kita bikin array JSON bahan baku untuk JS
                                    echo json_encode($bahan_baku);
                                    ?>`;

                const bahanArray = JSON.parse(bahanData);

                document.getElementById('addBahan').addEventListener('click', function() {
                    const tbody = document.getElementById('bahanTable').getElementsByTagName('tbody')[0];
                    const newRow = document.querySelector('.bahan-row').cloneNode(true);

                    // Reset input value
                    newRow.querySelector('input').value = '';

                    // Reset dropdown
                    const select = newRow.querySelector('select');
                    select.innerHTML = '<option value="">-- Pilih Bahan --</option>';
                    bahanArray.forEach(b => {
                        const option = document.createElement('option');
                        option.value = b.nama;
                        option.text = `${b.nama} (${b.jumlah} ${b.satuan})`;
                        select.appendChild(option);
                    });

                    tbody.appendChild(newRow);
                });

                document.querySelector('#bahanTable').addEventListener('click', function(e) {
                    if (e.target.classList.contains('remove-row')) {
                        const tbody = e.target.closest('tbody');
                        if (tbody.rows.length > 1) e.target.closest('tr').remove();
                    }
                });
            </script>
        </form>
    </div>
</div>