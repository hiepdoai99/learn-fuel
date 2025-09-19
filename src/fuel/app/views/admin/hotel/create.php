<div class="card shadow-sm p-4 mb-4">
    <h2 class="mb-4">
        <?php echo isset($hotel) ? 'Sửa khách sạn' : 'Thêm khách sạn'; ?>
    </h2>

    <?php echo Form::open([
        'action' => isset($hotel) 
            ? 'admin/hotel/edit/'.$hotel->id 
            : 'admin/hotel/create',
        'method' => 'post',
        'enctype' => 'multipart/form-data',
        'class' => 'needs-validation'
    ]); ?>

    <div class="mb-3">
        <?php echo Form::label('Tên khách sạn', 'name', ['class' => 'form-label']); ?>
        <?php echo Form::input('name', isset($hotel) ? $hotel->name : '', [
            'class' => 'form-control',
            'placeholder' => 'Nhập tên khách sạn'
        ]); ?>
    </div>

    <div class="mb-3">
        <?php echo Form::label('Địa chỉ', 'address', ['class' => 'form-label']); ?>
        <?php echo Form::input('address', isset($hotel) ? $hotel->address : '', [
            'class' => 'form-control',
            'placeholder' => 'Nhập địa chỉ'
        ]); ?>
    </div>

    <div class="mb-3">
        <?php echo Form::label('Tỉnh/Thành', 'province_id', ['class' => 'form-label']); ?>
        <?php echo Form::select('province_id', 
            isset($hotel) ? $hotel->province_id : '', 
            $provinces, // Truyền từ controller dạng [id => tên]
            ['class' => 'form-select']
        ); ?>
    </div>

    <div class="mb-3">
        <?php echo Form::label('Mô tả', 'description', ['class' => 'form-label']); ?>
        <?php echo Form::textarea('description', isset($hotel) ? $hotel->description : '', [
            'class' => 'form-control',
            'rows' => 4,
            'placeholder' => 'Mô tả chi tiết khách sạn'
        ]); ?>
    </div>

    <div class="mb-3">
        <?php echo Form::label('Ảnh khách sạn', 'image', ['class' => 'form-label']); ?>
        <?php echo Form::file('image', ['class' => 'form-control']); ?>
        <?php if (!empty($hotel) && $hotel->image): ?>
            <div class="mt-2">
                <img src="<?php echo Uri::create('uploads/hotels/'.$hotel->image); ?>" 
                     alt="Hotel Image" class="img-thumbnail" style="max-height:150px;">
            </div>
        <?php endif; ?>
    </div>

    <div class="d-flex justify-content-between">
        <a href="<?php echo Uri::create('admin/hotel'); ?>" class="btn btn-secondary">
            Quay lại
        </a>
        <?php echo Form::submit('submit', 'Lưu', ['class' => 'btn btn-success']); ?>
    </div>

    <?php echo Form::close(); ?>
</div>
