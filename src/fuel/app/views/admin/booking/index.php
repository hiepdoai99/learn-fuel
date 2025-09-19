<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Danh sách Booking</h2>
    <a href="<?php echo Uri::create('admin/booking/create'); ?>" class="btn btn-primary">
        + Tạo booking
    </a>
</div>

<?php if ($bookings): ?>
<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Hotel</th>
            <th>Room</th>
            <th>Customer</th>
            
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Status</th>
            <th>Note</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($bookings as $booking): ?>
        <tr>
            <td><?php echo $booking->id; ?></td>
            
            <!-- user_id có thể null -->
            <td>
                <?php echo $booking->user ? e($booking->user->name) : '<span class="text-muted">Khách vãng lai</span>'; ?>
            </td>

             <td>
                <?php echo ($booking->room && $booking->room->hotel) 
                    ? e($booking->room->hotel->name) 
                    : '<span class="text-muted">N/A</span>'; ?>
            </td>
            
            <!-- room -->
            <td>
                <?php echo $booking->room ? 'Phòng '.$booking->room->room_number : e($booking->room_id); ?>
            </td>

            <!-- customer info -->
            <td>
                <strong>Name: <?php echo e($booking->customer_name); ?></strong><br>
                <small>Email: <?php echo e($booking->customer_email); ?></small><br>
                 <small>Phone: <?php echo e($booking->customer_phone); ?></small>
                
            </td>

            
            <td><?php echo e($booking->check_in); ?></td>
            <td><?php echo e($booking->check_out); ?></td>

            <td>
                <?php
                    $statusClass = [
                        'pending' => 'secondary',
                        'deposit' => 'info',
                        'checked_in' => 'success',
                        'canceled' => 'danger'
                    ];
                    $class = $statusClass[$booking->status] ?? 'secondary';
                ?>
                <span class="badge bg-<?php echo $class; ?>">
                    <?php echo ucfirst(str_replace('_', ' ', $booking->status)); ?>
                </span>
            </td>

            <td><?php echo e($booking->note); ?></td>

            <td>
                <a href="<?php echo Uri::create('admin/booking/view/'.$booking->id); ?>" class="btn btn-sm btn-info">Xem</a>
                <a href="<?php echo Uri::create('admin/booking/edit/'.$booking->id); ?>" class="btn btn-sm btn-warning">Sửa</a>
                
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p>Chưa có booking nào.</p>
<?php endif; ?>
