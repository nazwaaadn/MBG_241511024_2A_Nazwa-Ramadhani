<div class="container mt-5">

    <!-- Card Judul -->
    <div class="card text-center mb-4 shadow-sm border-primary custom-card" 
         style="border: 1px solid #0d6efd; border-radius: 10px;">
        <div class="card-body">
            <h4 class="mb-0 text-primary">Form Edit Data Bahan Baku</h4>
        </div>
    </div>

    <!-- Card Form -->
    <div class="card custom-card form-card shadow-sm border-primary" 
         style="border-radius: 10px;">
        <div class="card-body">
            <form action="<?= site_url('/BahanBaku/update/'.$BahanBaku['id']) ?>" method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label for="Jumlah" class="form-label">Jumlah</label>
                    <input type="text" 
                           class="form-control" 
                           id="Jumlah" 
                           name="jumlah" 
                           value="<?= $BahanBaku['jumlah']; ?>">
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
