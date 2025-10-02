<div class="container outer-container">

    <!-- Card Judul -->
    <div class="card text-center mb-4 shadow-sm border-primary custom-card" style="border: 1px solid #0d6efd; border-radius: 10px;">
        <div class="card-body">
            <h4 class="mb-0 text-primary">Form Add Data Bahan Baku</h4>
        </div>
    </div>

    <!-- Card Form -->
    <div class="card custom-card form-card" style="border-radius: 20px;">
        <div class="card-body p-4">
            <form action="<?= site_url('/BahanBaku/store') ?>" method="post">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="Nama" class="form-label">Nama</label>
                    <input type="text"
                        class="form-control <?= session('errors.nama') ? 'is-invalid' : '' ?>"
                        id="Nama"
                        name="nama"
                        placeholder="Masukkan nama bahan baku"
                        value="<?= old('nama') ?>">
                    <?php if (session('errors.nama')): ?>
                        <div class="invalid-feedback">
                            <?= session('errors.nama') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                <label for="Kategori" class="form-label">Kategori</label>
                <select 
                    class="form-select <?= session('errors.kategori') ? 'is-invalid' : '' ?>" 
                    id="Kategori" 
                    name="kategori">
                    <option value="" disabled selected>Pilih kategori bahan</option>
                    <option value="Karbohidrat" <?= old('kategori') == 'Karbohidrat' ? 'selected' : '' ?>>Karbohidrat</option>
                    <option value="Protein Hewani" <?= old('kategori') == 'Protein Hewani' ? 'selected' : '' ?>>Protein Hewani</option>
                    <option value="Protein Nabati" <?= old('kategori') == 'Protein Nabati' ? 'selected' : '' ?>>Protein Nabati</option>
                    <option value="Sayuran" <?= old('kategori') == 'Sayuran' ? 'selected' : '' ?>>Sayuran</option>
                    <option value="Buah-buahan" <?= old('kategori') == 'Buah-buahan' ? 'selected' : '' ?>>Buah-buahan</option>
                    <option value="Bahan Masak" <?= old('kategori') == 'Bahan Masak' ? 'selected' : '' ?>>Bahan Masak</option>
                </select>

                <?php if (session('errors.kategori')): ?>
                    <div class="invalid-feedback">
                        <?= session('errors.kategori') ?>
                    </div>
                <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="Jumlah" class="form-label">Jumlah</label>
                    <input type="number"
                        class="form-control <?= session('errors.jumlah') ? 'is-invalid' : '' ?>"
                        id="Jumlah"
                        name="jumlah"
                        placeholder="Masukkan jumlah bahan"
                        value="<?= old('jumlah') ?>">
                    <?php if (session('errors.jumlah')): ?>
                        <div class="invalid-feedback">
                            <?= session('errors.jumlah') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Satuan</label>

                    <div class="d-flex align-items-center gap-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input <?= session('errors.satuan') ? 'is-invalid' : '' ?>"
                                type="radio"
                                name="satuan"
                                id="satuanKg"
                                value="kg"
                                <?= old('satuan') == 'kg' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="satuanKg">Kg</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input <?= session('errors.satuan') ? 'is-invalid' : '' ?>"
                                type="radio"
                                name="satuan"
                                id="satuanLiter"
                                value="liter"
                                <?= old('satuan') == 'liter' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="satuanLiter">Liter</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input <?= session('errors.satuan') ? 'is-invalid' : '' ?>"
                                type="radio"
                                name="satuan"
                                id="Potong"
                                value="potong"
                                <?= old('satuan') == 'potong' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="Potong">Potong</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input <?= session('errors.satuan') ? 'is-invalid' : '' ?>"
                                type="radio"
                                name="satuan"
                                id="Butir"
                                value="butir"
                                <?= old('satuan') == 'butir' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="Butir">Butir</label>
                        </div>

                        <?php if (session('errors.satuan')): ?>
                            <small class="text-danger ms-2">
                                <?= session('errors.satuan') ?>
                            </small>
                        <?php endif; ?>
                    </div>
                </div>


                <div class="mb-3">
                    <label for="TanggalMasuk" class="form-label">Tanggal Masuk</label>
                    <input type="date"
                        class="form-control <?= session('errors.tanggal_masuk') ? 'is-invalid' : '' ?>"
                        id="TanggalMasuk"
                        name="tanggal_masuk"
                        value="<?= old('tanggal_masuk') ?>">
                    <?php if (session('errors.tanggal_masuk')): ?>
                        <div class="invalid-feedback">
                            <?= session('errors.tanggal_masuk') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="TanggalKadaluarsa" class="form-label">Tanggal Kadaluarsa</label>
                    <input type="date"
                        class="form-control <?= session('errors.tanggal_kadaluarsa') ? 'is-invalid' : '' ?>"
                        id="TanggalKadaluarsa"
                        name="tanggal_kadaluarsa"
                        value="<?= old('tanggal_kadaluarsa') ?>">
                    <?php if (session('errors.tanggal_kadaluarsa')): ?>
                        <div class="invalid-feedback">
                            <?= session('errors.tanggal_kadaluarsa') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>
    </div>
</div>