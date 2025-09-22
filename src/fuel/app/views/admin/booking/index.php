<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Danh sách Booking</h2>
    <a href="<?php echo Uri::create('admin/booking/create'); ?>" class="btn btn-primary">
        + Tạo booking
    </a>
</div>
<form method="get" class="row g-2 mb-3">
    <div class="col-md-2">
        <input type="text" name="name" value="<?php echo Input::get('name'); ?>" class="form-control"
            placeholder="Tên khách">
    </div>
    <div class="col-md-2">
        <input type="text" name="email" value="<?php echo Input::get('email'); ?>" class="form-control"
            placeholder="Email">
    </div>
    <div class="col-md-2">
        <input type="text" name="phone" value="<?php echo Input::get('phone'); ?>" class="form-control"
            placeholder="Số điện thoại">
    </div>
    <div class="col-md-2">
        <select name="province_id" class="form-control">
            <option value="">-- Tỉnh --</option>
            <?php foreach (Model_Province::find('all', ['order_by' => ['name' => 'asc']]) as $p): ?>
                <option value="<?php echo $p->id; ?>" <?php echo Input::get('province_id') == $p->id ? 'selected' : ''; ?>>
                    <?php echo e($p->name); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-2">
        <select name="hotel_id" class="form-control">
            <option value="">-- Khách sạn --</option>
            <?php foreach (Model_Hotel::find('all', ['order_by' => ['name' => 'asc']]) as $h): ?>
                <option value="<?php echo $h->id; ?>" <?php echo Input::get('hotel_id') == $h->id ? 'selected' : ''; ?>>
                    <?php echo e($h->name); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-2">
        <select name="room_id" class="form-control">
            <option value="">-- Phòng --</option>
            <?php foreach (Model_Room::find('all') as $r): ?>
                <option value="<?php echo $r->id; ?>" <?php echo Input::get('room_id') == $r->id ? 'selected' : ''; ?>>
                    Phòng <?php echo e($r->room_number); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-2">
        <input type="date" name="check_in" value="<?php echo Input::get('check_in'); ?>" class="form-control">
    </div>
    <div class="col-md-2">
        <input type="date" name="check_out" value="<?php echo Input::get('check_out'); ?>" class="form-control">
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-success w-100">Search</button>
    </div>
</form>

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
                        <?php echo $booking->room ? 'Phòng ' . $booking->room->room_number : e($booking->room_id); ?>
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
                        <a href="<?php echo Uri::create('admin/booking/view/' . $booking->id); ?>"
                            class="btn btn-sm btn-info">Xem</a>
                        <a href="<?php echo Uri::create('admin/booking/edit/' . $booking->id); ?>"
                            class="btn btn-sm btn-warning">Sửa</a>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


    <?php if (!empty($pager_html)): ?>
        <div class="mt-3">
            <?php echo html_entity_decode($pager_html); ?>
        </div>
    <?php endif; ?>

<?php else: ?>
    <p>Chưa có booking nào.</p>
<?php endif; ?>
