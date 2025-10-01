<?php if (!empty($students)): ?>
    <?php foreach ($students as $std): ?>
    <tr>
        <td><?= $std['student_id']; ?></td>
        <td><?= $std['full_name']; ?></td>
        <td>
            <a href="<?= base_url('/students/detail/' . $std['student_id']) ?>" class="btn btn-success">Detail</a>
            <a href="<?= base_url('/students/edit/' . $std['student_id']) ?>" class="btn btn-warning">Edit</a>
            <a href="<?= base_url('/students/delete/' . $std['student_id']) ?>" class="btn btn-danger">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="3" class="text-center">Tidak ada hasil</td>
    </tr>
<?php endif; ?>
