<?php if (!empty($permintaan)): ?>
    <?php foreach ($permintaan as $p): ?>
        <tr>
            <td><?= $p['nama_pemohon']; ?></td>
            <td><?= $p['menu_makan']; ?></td>
            <td><?= $p['jumlah_porsi']; ?></td>
            <td><?= date('d-m-Y', strtotime($p['tgl_masak'])); ?></td>
            <td>
                <?php if ($p['status'] == 'menunggu'): ?>
                    <span class="badge bg-warning text-dark"><?= $p['status']; ?></span>
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
<?php else: ?>
    <tr>
        <td colspan="3" class="text-center">Tidak ada hasil</td>
    </tr>
<?php endif; ?>