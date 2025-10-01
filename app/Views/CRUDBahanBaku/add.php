
    <div class="container">
        <h2>Form Add Data</h2><br>
        <form action="<?= site_url('/BahanBaku/store') ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="Nama" class="form-label">Nama</label>
                <input type="text" 
                       class="form-control <?= session('errors.nama') ? 'is-invalid' : '' ?>" 
                       id="Nama" 
                       name="nama" 
                       value="<?= old('nama') ?>">
                <?php if(session('errors.nama')): ?>
                    <div class="invalid-feedback">
                        <?= session('errors.nama') ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="Kategori" class="form-label">Kategori</label>
                <input type="text" 
                       class="form-control <?= session('errors.kategori') ? 'is-invalid' : '' ?>" 
                       id="Kategori" 
                       name="kategori" 
                       value="<?= old('kategori') ?>">
                <?php if(session('errors.kategori')): ?>
                    <div class="invalid-feedback">
                        <?= session('errors.kategori') ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="Jumlah" class="form-label">Jumlah</label>
                <input type="text" 
                       class="form-control <?= session('errors.jumlah') ? 'is-invalid' : '' ?>" 
                       id="Jumlah" 
                       name="jumlah" 
                       value="<?= old('jumlah') ?>">
                <?php if(session('errors.jumlah')): ?>
                    <div class="invalid-feedback">
                        <?= session('errors.jumlah') ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="Satuan" class="form-label">Satuan</label>
                <input type="text" 
                       class="form-control <?= session('errors.satuan') ? 'is-invalid' : '' ?>" 
                       id="Satuan" 
                       name="satuan" 
                       value="<?= old('satuan') ?>">
                <?php if(session('errors.satuan')): ?>
                    <div class="invalid-feedback">
                        <?= session('errors.satuan') ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="Tanggal Masuk" class="form-label">Tanggal Masuk</label>
                <input type="date" 
                       class="form-control <?= session('errors.tanggal_masuk') ? 'is-invalid' : '' ?>" 
                       id="Tanggal Masuk" 
                       name="tanggal_masuk" 
                       value="<?= old('tanggal_masuk') ?>">
                <?php if(session('errors.tanggal_masuk')): ?>
                    <div class="invalid-feedback">
                        <?= session('errors.tanggal_masuk') ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="Tanggal Kadaluarsa" class="form-label">Tanggal Kadaluarsa</label>
                <input type="date" 
                       class="form-control <?= session('errors.tanggal_kadaluarsa') ? 'is-invalid' : '' ?>" 
                       id="Tanggal Kadaluarsa" 
                       name="tanggal_kadaluarsa" 
                       value="<?= old('tanggal_kadaluarsa') ?>">
                <?php if(session('errors.tanggal_kadaluarsa')): ?>
                    <div class="invalid-feedback">
                        <?= session('errors.tanggal_kadaluarsa') ?>
                    </div>
                <?php endif; ?>
            </div>

            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>