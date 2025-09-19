<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Danh sách Tỉnh/Thành</h2>
    <a href="<?php echo Uri::create('admin/province/create'); ?>" class="btn btn-primary">
        + Thêm tỉnh/thành
    </a>
</div>

<?php if ($provinces): ?>
<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Tên tỉnh/thành</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($provinces as $item): ?>
        <tr>
            <td><?php echo $item->id; ?></td>
            <td><?php echo e($item->name); ?></td>
            <td>
                <a href="<?php echo Uri::create('admin/province/view/'.$item->id); ?>" class="btn btn-sm btn-info">Xem</a>
                <a href="<?php echo Uri::create('admin/province/edit/'.$item->id); ?>" class="btn btn-sm btn-warning">Sửa</a>
                <a href="<?php echo Uri::create('admin/province/delete/'.$item->id); ?>" 
                   class="btn btn-sm btn-danger" 
                   onclick="return confirm('Bạn chắc chắn muốn xóa?')">Xóa</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p>Chưa có tỉnh/thành nào.</p>
<?php endif; ?>
