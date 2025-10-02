<style>
    .custom-box {
        box-shadow: 0 4px 12px rgba(13, 14, 14, 0.15); /* shadow biru lembut */
        border-radius: 8px;
    }
</style>

<div class="container mt-3'">

    <!-- Notifikasi Flash -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Judul dalam box -->
    <div class="card custom-box mb-4 p-2">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h4 class="mb-0">List Bahan Baku</h3>
            <a href="<?= base_url('/BahanBaku/add') ?>" class="btn btn-success">+ Add Data</a>
        </div>
    </div>

    <!-- Table dalam box -->
    <div class="card custom-box p-3">
        <div class="card-body">
             <input type="text" id="search" class="form-control mb-4" placeholder="Cari Bahan Baku...">
            <table class="table table-hover mb-0" >
                <thead class="bg-white">
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Status</th>
                        <th scope="col" style="width: 220px;">Action</th>
                    </tr>
                </thead>
                <tbody id="result">
                    <?php foreach ($bahan_baku as $bb): ?>
                        <tr>
                            <td><?= $bb['nama']; ?></td>
                            <td><?= $bb['kategori']; ?></td>
                            <td>
                                <?php if ($bb['jumlah'] == 0): ?>
                                    <span class="badge bg-secondary">Habis</span>
                                <?php else:  ?>
                                    <?php if ($bb['status'] == 'tersedia'): ?>
                                        <span class="badge bg-success"><?= $bb['status']; ?></span>
                                    <?php elseif ($bb['status'] == 'segera_kadaluarsa'): ?>
                                        <span class="badge bg-warning text-dark">Segera Kadaluarsa</span>
                                    <?php elseif ($bb['status'] == 'kadaluarsa'): ?>
                                        <span class="badge bg-danger"><?= $bb['status']; ?></span>
                                
                                    <?php else: ?>
                                        <span class="badge bg-secondary"><?= $bb['status']; ?></span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <!-- Detail -->
                                    <a href="<?= base_url('/BahanBaku/detail/' . $bb['id']) ?>" 
                                       class="btn btn-sm btn-info">Detail</a>
                                    <!-- Edit -->
                                    <a href="<?= base_url('/BahanBaku/edit/' . $bb['id']) ?>" 
                                       class="btn btn-sm btn-warning">Edit</a>
                                    <!-- Delete -->
                                    <form action="<?= base_url('/BahanBaku/delete/' . $bb['id']) ?>" 
                                          method="POST" class="deleteForm">
                                        <button type="submit" class="btn btn-danger btn-sm" 
                                            data-nama="<?= $bb['nama']; ?>"
                                            data-kategori="<?= $bb['kategori']; ?>">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.deleteForm').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            // ambil data dari button
            let btn = form.querySelector('button[type="submit"]');
            let nama = btn.getAttribute('data-nama');
            let kategori = btn.getAttribute('data-kategori');
            let stok = btn.getAttribute('data-stok');

            Swal.fire({
                title: 'Apakah yakin ingin menghapus data ini?',
                html: `
                    <p><b>Nama Bahan:</b> ${nama} <b>Kategori:</b> ${kategori}</p>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $("#search").on("keyup", function() {
            let keyword = $(this).val();

            $.ajax({
                url: "<?= base_url('BahanBaku/search') ?>", // bikin method di controller
                type: "GET",
                data: {
                    keyword: keyword
                },
                success: function(response) {
                    $("#result").html(response); // ganti isi tbody dengan hasil pencarian
                }
            });
        });
    });
</script>
