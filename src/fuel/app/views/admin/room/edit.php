<h2>Sửa phòng #<?php echo $room->id; ?></h2>

<?php echo Form::open(['action' => 'admin/room/edit/'.$room->id]); ?>
    <p>
        <?php echo Form::label('Hotel ID', 'hotel_id'); ?><br>
        <?php echo Form::input('hotel_id', Input::post('hotel_id', $room->hotel_id)); ?>
    </p>
    <p>
        <?php echo Form::label('Số phòng', 'room_number'); ?><br>
        <?php echo Form::input('room_number', Input::post('room_number', $room->room_number)); ?>
    </p>
    <p>
        <?php echo Form::label('Loại', 'type'); ?><br>
        <?php echo Form::input('type', Input::post('type', $room->type)); ?>
    </p>
    <p>
        <?php echo Form::label('Giá', 'price'); ?><br>
        <?php echo Form::input('price', Input::post('price', $room->price)); ?>
    </p>
    <p><?php echo Form::submit('submit', 'Cập nhật'); ?></p>
<?php echo Form::close(); ?>

<p><?php echo Html::anchor('admin/room', 'Quay lại danh sách'); ?></p>
