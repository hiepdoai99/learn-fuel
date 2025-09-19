<h2>Chi tiết phòng #<?php echo $room->id; ?></h2>

<p><strong>Hotel ID:</strong> <?php echo $room->hotel_id; ?></p>
<p><strong>Số phòng:</strong> <?php echo $room->room_number; ?></p>
<p><strong>Loại:</strong> <?php echo $room->type; ?></p>
<p><strong>Giá:</strong> <?php echo $room->price; ?></p>

<p><?php echo Html::anchor('admin/room/edit/'.$room->id, 'Sửa'); ?> |
   <?php echo Html::anchor('admin/room', 'Quay lại danh sách'); ?></p>
