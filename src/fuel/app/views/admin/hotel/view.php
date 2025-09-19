<div class="card shadow-sm p-4 mb-4">
    <h2 class="mb-4">Chi tiết Khách sạn</h2>

    <dl class="row">
        <dt class="col-sm-3">Tên</dt>
        <dd class="col-sm-9"><?php echo e($hotel->name); ?></dd>

        <dt class="col-sm-3">Địa chỉ</dt>
        <dd class="col-sm-9"><?php echo e($hotel->address); ?></dd>

        <dt class="col-sm-3">Tỉnh/Thành</dt>
        <dd class="col-sm-9"><?php echo e($hotel->province ? $hotel->province->name : '---'); ?></dd>

        <dt class="col-sm-3">Mô tả</dt>
        <dd class="col-sm-9"><?php echo nl2br(e($hotel->description)); ?></dd>

        <dt class="col-sm-3">Ảnh</dt>
        <dd class="col-sm-9">
            <?php if ($hotel->image): ?>
                <img src="<?php echo Uri::create('uploads/hotels/'.$hotel->image); ?>" 
                     alt="Hotel Image" class="img-fluid rounded" style="max-height:300px;">
            <?php else: ?>
                <em>Chưa có ảnh</em>
            <?php endif; ?>
        </dd>
    </dl>

    <div class="d-flex justify-content-between mt-4">
        <a href="<?php echo Uri::create('admin/hotel'); ?>" class="btn btn-secondary">Quay lại</a>
        <div>
            <a href="<?php echo Uri::create('admin/hotel/edit/'.$hotel->id); ?>" class="btn btn-warning">Sửa</a>
            <a href="<?php echo Uri::create('admin/hotel/delete/'.$hotel->id); ?>" 
               class="btn btn-danger"
               onclick="return confirm('Chắc chắn xóa khách sạn này?')">Xóa</a>
        </div>
    </div>
</div>
