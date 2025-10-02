<?php if (!empty($bahan_baku)): ?>
    <?php foreach ($bahan_baku as $bb): ?>
        <tr>
            <td><?= $bb['nama']; ?></td>
            <td><?= $bb['kategori']; ?></td>
            <td>
                <?php if ($bb['status'] == 'tersedia'): ?>
                    <span class="badge bg-success"><?= $bb['status']; ?></span>
                <?php elseif ($bb['status'] == 'segera_kadaluarsa'): ?>
                    <span class="badge bg-warning text-dark">Segera Kadaluarsa</span>
                <?php elseif ($bb['status'] == 'kadaluarsa'): ?>
                    <span class="badge bg-danger"><?= $bb['status']; ?></span>
                <?php else: ?>
                    <span class="badge bg-secondary"><?= $bb['status']; ?></span>
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
                        <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                    </form>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="3" class="text-center">Tidak ada hasil</td>
    </tr>
<?php endif; ?>