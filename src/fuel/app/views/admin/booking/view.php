<h2>Chi tiết Booking #<?php echo $booking->id; ?></h2>

<table class="table table-bordered">
    <tr><th>ID</th><td><?php echo $booking->id; ?></td></tr>
    <tr><th>User</th><td><?php echo $booking->user ? e($booking->user->name) : 'Khách vãng lai'; ?></td></tr>
    <tr><th>Room</th><td><?php echo $booking->room ? 'Phòng '.$booking->room->room_number : e($booking->room_id); ?></td></tr>
    <tr><th>Customer</th><td><?php echo e($booking->customer_name); ?></td></tr>
    <tr><th>Email</th><td><?php echo e($booking->customer_email); ?></td></tr>
    <tr><th>Phone</th><td><?php echo e($booking->customer_phone); ?></td></tr>
    <tr><th>Check-in</th><td><?php echo e($booking->check_in); ?></td></tr>
    <tr><th>Check-out</th><td><?php echo e($booking->check_out); ?></td></tr>
    <tr><th>Status</th><td><?php echo ucfirst(str_replace('_', ' ', $booking->status)); ?></td></tr>
    <tr><th>Note</th><td><?php echo e($booking->note); ?></td></tr>
</table>

<a href="<?php echo Uri::create('admin/booking/edit/'.$booking->id); ?>" class="btn btn-warning">Sửa</a>
<a href="<?php echo Uri::create('admin/booking'); ?>" class="btn btn-secondary">Quay lại</a>
