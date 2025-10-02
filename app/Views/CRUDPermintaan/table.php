<style>
    .custom-box {
        box-shadow: 0 4px 12px rgba(13, 14, 14, 0.15);
        /* shadow biru lembut */
        border-radius: 8px;
    }
</style>

<div class="container mt-3">

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
            <h4 class="mb-0">List Permintaan</h4>
        </div>
    </div>

    <!-- Table -->
    <div class="card custom-box p-3">
        <div class="card-body">
            <input type="text" id="search" class="form-control mb-4" placeholder="Cari Permintaan...">
            <table class="table table-hover mb-0">
                <thead class="bg-white">
                    <tr>
                        <th scope="col">Pemohon</th>
                        <th scope="col">Menu Makan</th>
                        <th scope="col">Jumlah Porsi</th>
                        <th scope="col">Tanggal Masak</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="result">
                    <?php foreach ($permintaan as $p): ?>
                        <tr>
                            <td><?= $p['nama_pemohon']; ?></td>
                            <td><?= $p['menu_makan']; ?></td>
                            <td><?= $p['jumlah_porsi']; ?></td>
                            <td><?= date('d-m-Y', strtotime($p['tgl_masak'])); ?></td>
                            <td>
                                <?php if ($p['status'] == 'menunggu'): ?>
                                    <span class="badge bg-warning text-dark"><?= $p['status']; ?></span>
                                <?php elseif ($p['status'] == 'disetujui'): ?>
                                    <span class="badge bg-success"><?= $p['status']; ?></span>
                                <?php elseif ($p['status'] == 'ditolak'): ?>
                                    <span class="badge bg-danger"><?= $p['status']; ?></span>
                                <?php else: ?>
                                    <span class="badge bg-secondary"><?= $p['status']; ?></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="d-flex gap-2">

                                    <!-- Edit Status pakai modal -->
                                    <button class="btn btn-sm btn-warning editStatusBtn"
                                        data-id="<?= $p['id']; ?>"
                                        data-status="<?= $p['status']; ?>">
                                        Edit Status
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>


            <!-- Modal Edit Status -->
            <div class="modal fade" id="editStatusModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <form id="editStatusForm" method="post" action="<?= base_url('Permintaan/updateStatus') ?>">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Status Permintaan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" id="permintaanId">

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-select" required>
                                        <option value="menunggu">Menunggu</option>
                                        <option value="disetujui">Disetujui</option>
                                        <option value="ditolak">Ditolak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
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
        $(document).on('click', '.editStatusBtn', function() {
            let id = $(this).data('id');
            let status = $(this).data('status');

            $('#permintaanId').val(id);
            $('#status').val(status);

            $('#editStatusModal').modal('show');
        });


        $(document).ready(function() {
            $("#search").on("keyup", function() {
                let keyword = $(this).val();

                $.ajax({
                    url: "<?= base_url('Permintaan/search') ?>",
                    type: "GET",
                    data: {
                        keyword: keyword
                    },
                    success: function(response) {
                        $("#result").html(response);
                    }
                });
            });
        });
    </script>