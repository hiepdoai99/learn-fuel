<h2>
    <?php echo isset($room) ? 'Sửa phòng #' . $room->id : 'Thêm phòng mới'; ?>
</h2>

<?php echo Form::open(['enctype' => 'multipart/form-data']); ?>

<div class="form-group">
    <?php echo Form::label('Khách sạn', 'hotel_id'); ?>
    <?php echo Form::select('hotel_id',
        isset($room) ? $room->hotel_id : '',
        \Arr::pluck($hotels, 'name', 'id'),
        ['class' => 'form-control']); ?>
</div>

<div class="form-group">
    <?php echo Form::label('Số phòng', 'room_number'); ?>
    <?php echo Form::input('room_number',
        isset($room) ? $room->room_number : '',
        ['class' => 'form-control']); ?>
</div>

<div class="form-group">
    <?php echo Form::label('Loại phòng', 'type'); ?>
    <?php echo Form::select('type',
        isset($room) ? $room->type : '',
        $types,
        ['class' => 'form-control']); ?>
</div>

<div class="form-group">
    <?php echo Form::label('Giá', 'price'); ?>
    <?php echo Form::input('price',
        isset($room) ? $room->price : '',
        ['class' => 'form-control']); ?>
</div>

<div class="form-group">
    <?php echo Form::label('Ảnh phòng (có thể chọn nhiều)', 'images[]'); ?>
    <?php echo Form::file('images[]', [
        'multiple' => true,
        'class' => 'form-control'
    ]); ?>
</div>

<?php if (isset($room) && $room->images): ?>
    <div class="form-group">
        <label>Ảnh đã có:</label>
        <div style="display:flex; gap:10px; flex-wrap:wrap;">
            <?php foreach ($room->images as $img): ?>
                <div>
                    <img src="<?php echo Uri::base().'uploads/rooms/'.$img->image; ?>"
                         style="max-width:150px; border:1px solid #ccc; padding:3px;">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

<div class="form-group">
    <?php echo Form::submit('submit',
        isset($room) ? 'Cập nhật' : 'Thêm mới',
        ['class' => 'btn btn-primary']); ?>
</div>

<?php echo Form::close(); ?>
