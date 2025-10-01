
    <div class="container">
        <h2>Form Edit Data</h2><br>
        <form action="<?= site_url('/BahanBaku/update/'.$BahanBaku['id']) ?>" method="post">
            <?= csrf_field() ?>
        <div class="mb-3">
            <label for="Jumlah" class="form-label">jumlah</label>
            <input type="text" class="form-control" id="Jumlah" name="jumlah" value="<?= $BahanBaku['jumlah']; ?>">
        </div>
        

        <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>