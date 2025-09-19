<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Danh sách Khách sạn</h2>
    <a href="<?php echo Uri::create('admin/hotel/create'); ?>" class="btn btn-primary">
        + Thêm khách sạn
    </a>
</div>

<?php if ($hotels): ?>
<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Địa chỉ</th>
            <th>Mô tả</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($hotels as $hotel): ?>
        <tr>
            <td><?php echo $hotel->id; ?></td>
            <td><?php echo e($hotel->name); ?></td>
            <td><?php echo e($hotel->address); ?></td>
            <td><?php echo e($hotel->description); ?></td>
            <td>
                <a href="<?php echo Uri::create('admin/hotel/view/'.$hotel->id); ?>" class="btn btn-sm btn-info">Xem</a>
                <a href="<?php echo Uri::create('admin/hotel/edit/'.$hotel->id); ?>" class="btn btn-sm btn-warning">Sửa</a>
                <a href="<?php echo Uri::create('admin/hotel/delete/'.$hotel->id); ?>" 
                   class="btn btn-sm btn-danger" 
                   onclick="return confirm('Chắc chắn xóa?')">Xóa</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p>Chưa có khách sạn nào.</p>
<?php endif; ?>
