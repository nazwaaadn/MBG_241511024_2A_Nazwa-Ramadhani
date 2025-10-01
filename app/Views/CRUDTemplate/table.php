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
                <h3 style="width: 820px">List Mahasiswa</h3>
            </th>
            <th><a href="<?= base_url('/students/add') ?>" class="btn btn-primary">Add Data</a></th>
        </tr>
    </table>

    <input style="width: 915px;" type="text" id="search" class="form-control mb-3" placeholder="Cari student...">

    <table class="table caption-top">
        <thead>
            <tr>
                <th scope="col" width="250px">Student ID</th>
                <th scope="col" width="450px">Full Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody id="result">
            <?php foreach ($students as $mhs): ?>
                <tr>
                    <td><?= $mhs['student_id']; ?></td>
                    <td><?= $mhs['full_name']; ?></td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="<?= base_url('/students/detail/' . $mhs['student_id']) ?>" class="btn btn-success">Detail</a>
                            <a href="<?= base_url('/students/edit/' . $mhs['student_id']) ?>" class="btn btn-warning">Edit</a>
                            <form action="<?= base_url('/students/delete/' . $mhs['student_id']) ?>" method="POST" class="deleteForm">
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
<script>
    $(document).ready(function() {
        $("#search").on("keyup", function() {
            let keyword = $(this).val();

            $.ajax({
                url: "<?= base_url('students/search') ?>", // bikin method di controller
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