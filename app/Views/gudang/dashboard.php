<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .custom-card {
        width: 20rem;
        padding: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        /* shadow lembut */
        border: 1px solid #0d6efd;
        /* border biru tipis */
        border-radius: 12px;
    }

    .custom-card .card-icon {
        font-size: 40px;
        color: #0d6efd;
        /* biru cerah */
        margin-bottom: 10px;
    }

    .custom-card .card-text {
        font-size: 0.9rem;
        /* kecilin teks deskripsi */
        color: #6c757d;
        /* abu-abu biar soft */
    }
</style>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">
                        <h2><?php echo $totalBahanBaku; ?></h2>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link">Jumlah Bahan Baku</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        <h2><?php echo $totalTersedia; ?></h2>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link">Bahan Baku yang tersedia</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        <h2><?php echo $totalKadaluarsa; ?></h2>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link">Bahan Baku yang Kadaluarsa</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">
                        <h2><?php echo $totalPermintaan; ?></h2>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link">Total Permintaan</a>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Fitur Gudang</li>
        </ol>
        <div class="d-flex flex-wrap gap-3 justify-content-start">
    <!-- Card pertama -->
    <div class="card custom-card" style="width: 300px;">
        <div class="card-body text-center">
            <i class="bi bi-box-seam card-icon" style="font-size: 2rem;"></i>
            <h5 class="card-title mt-2 mb-2">Kelola data Bahan baku</h5>
            <p class="card-text">
                Gunakan menu ini untuk menambah, mengubah, dan menghapus data bahan baku yang tersedia.
            </p>
            <a href="<?= base_url('/BahanBaku/display') ?>" class="btn btn-primary mt-2">Masuk</a>
        </div>
    </div>

    <!-- Card kedua -->
    <div class="card custom-card" style="width: 300px;">
        <div class="card-body text-center">
            <i class="bi bi-gear card-icon" style="font-size: 2rem;"></i>
            <h5 class="card-title mt-2 mb-2">Permintaan</h5>
            <p class="card-text">
                Gunakan menu ini untuk melihat daftar Permintaan dan Memberi Konfirmasi status Permintaan.
            </p>
            <a href="<?= base_url('/Permintaan/display') ?>" class="btn btn-primary mt-2">Masuk</a>
        </div>
    </div>
</div>




    </div>
</main>