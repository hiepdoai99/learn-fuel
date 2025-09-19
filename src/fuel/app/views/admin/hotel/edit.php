<h2>Sửa khách sạn</h2>

<?php echo Form::open(['enctype' => 'multipart/form-data']); ?>

    <div class="form-group">
        <?php echo Form::label('Tên khách sạn', 'name'); ?>
        <?php echo Form::input('name', Input::post('name', isset($hotel) ? $hotel->name : ''), ['class' => 'form-control']); ?>
    </div>

    <div class="form-group">
        <?php echo Form::label('Địa chỉ', 'address'); ?>
        <?php echo Form::input('address', Input::post('address', isset($hotel) ? $hotel->address : ''), ['class' => 'form-control']); ?>
    </div>

    <div class="form-group">
        <?php echo Form::label('Mô tả', 'description'); ?>
        <?php echo Form::textarea('description', Input::post('description', isset($hotel) ? $hotel->description : ''), ['class' => 'form-control', 'rows' => 5]); ?>
    </div>

    <div class="form-group">
        <?php echo Form::label('Tỉnh/Thành phố', 'province_id'); ?>
        <?php echo Form::select('province_id', Input::post('province_id', isset($hotel) ? $hotel->province_id : ''), $provinces, ['class' => 'form-control']); ?>
    </div>

    <div class="form-group">
        <?php echo Form::label('Ảnh hiện tại', 'current_image'); ?><br>
        <?php if (!empty($hotel->image)): ?>
            <img src="<?php echo Uri::base().'uploads/hotels/'.$hotel->image; ?>" style="max-width:200px; height:auto;">
        <?php else: ?>
            <p><em>Chưa có ảnh</em></p>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <?php echo Form::label('Ảnh mới (nếu muốn thay)', 'image'); ?>
        <?php echo Form::file('image'); ?>
    </div>

    <div class="form-group">
        <?php echo Form::submit('submit', 'Cập nhật', ['class' => 'btn btn-primary']); ?>
        <?php echo Html::anchor('admin/hotel', 'Quay lại', ['class' => 'btn btn-default']); ?>
    </div>

<?php echo Form::close(); ?>
