<div class="container">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <table class="mb-3">
        <tr>
            <th>
                <h3 style="width: 820px">List Bahan Baku</h3>
            </th>
            <th><a href="<?= base_url('/BahanBaku/add') ?>" class="btn btn-primary">Add Data</a></th>
        </tr>
    </table>

    <table class="table caption-top">
        <thead>
            <tr>
                <th scope="col">Nama</th>
                <th scope="col">Kategori</th>
                <th scope="col">Jumlah</th>
                <th scope="col">satuan</th>
                <th scope="col">Tanggal Masuk</th>
                <th scope="col">Tanggal Kadaluarsa</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody id="result">
            <?php foreach ($BahanBaku as $bb): ?>
                <tr>
                    <td><?= $bb['nama']; ?></td>
                    <td><?= $bb['kategori']; ?></td>
                    <td><?= $bb['jumlah']; ?></td>
                    <td><?= $bb['satuan']; ?></td>
                    <td><?= $bb['tanggal_masuk']; ?></td>
                    <td><?= $bb['tanggal_kadaluarsa']; ?></td>
                    <td><?= $bb['status']; ?></td>
                    
                    <td>
                        <div class="d-flex gap-2">
                            <a href="<?= base_url('/BahanBaku/edit/' . $bb['id']) ?>" class="btn btn-warning">Edit</a>
                            <form action="<?= base_url('/BahanBaku/delete/' . $bb['id']) ?>" method="POST" class="deleteForm">
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </div>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <script>
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
</script> -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.deleteForm').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure you want to delete?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>


</html>