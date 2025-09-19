<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Danh sách Phòng</h2>
    <a href="<?php echo Uri::create('admin/room/create'); ?>" class="btn btn-primary">
        + Thêm phòng
    </a>
</div>

<?php if ($rooms): ?>
<table class="table table-striped table-bordered align-middle">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Khách sạn</th>
            <th>Số phòng</th>
            <th>Loại</th>
            <th>Giá</th>
            <th>Ảnh</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($rooms as $room): ?>
        <tr>
            <td><?php echo $room->id; ?></td>
            <td><?php echo $room->hotel ? e($room->hotel->name) : '---'; ?></td>
            <td><?php echo e($room->room_number); ?></td>
            <td><?php echo e($room->type); ?></td>
            <td><?php echo number_format($room->price); ?> đ</td>
            <td>
                <?php if ($room->images): ?>
                    <?php foreach ($room->images as $img): ?>
                        <img src="<?php echo Uri::create('uploads/rooms/'.$img->image); ?>" 
                             alt="Room image"
                             style="max-height:50px; border-radius:5px;" 
                             class="me-1 shadow-sm">
                    <?php endforeach; ?>
                <?php else: ?>
                    <span class="text-muted">Không có ảnh</span>
                <?php endif; ?>
            </td>
            <td>
                <a href="<?php echo Uri::create('admin/room/view/'.$room->id); ?>" 
                   class="btn btn-sm btn-info">Xem</a>
                <a href="<?php echo Uri::create('admin/room/edit/'.$room->id); ?>" 
                   class="btn btn-sm btn-warning">Sửa</a>
                <a href="<?php echo Uri::create('admin/room/delete/'.$room->id); ?>" 
                   class="btn btn-sm btn-danger" 
                   onclick="return confirm('Chắc chắn xóa?')">Xóa</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p class="text-muted">Chưa có phòng nào.</p>
<?php endif; ?>
