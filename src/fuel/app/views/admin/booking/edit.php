<h2>Sửa Booking #<?php echo $booking->id; ?></h2>

<?php echo Form::open(['action' => 'admin/booking/edit/'.$booking->id, 'method' => 'post']); ?>
<?php echo Form::hidden('room_id', Input::post('room_id', $booking->room_id)); ?>

<div class="mb-3">
    <?php echo Form::label('Customer Name', 'customer_name', ['class' => 'form-label']); ?>
    <?php echo Form::input('customer_name', Input::post('customer_name', $booking->customer_name), ['class' => 'form-control']); ?>
</div>

<div class="mb-3">
    <?php echo Form::label('Email', 'customer_email', ['class' => 'form-label']); ?>
    <?php echo Form::input('customer_email', Input::post('customer_email', $booking->customer_email), ['class' => 'form-control']); ?>
</div>

<div class="mb-3">
    <?php echo Form::label('Phone', 'customer_phone', ['class' => 'form-label']); ?>
    <?php echo Form::input('customer_phone', Input::post('customer_phone', $booking->customer_phone), ['class' => 'form-control']); ?>
</div>

<div class="mb-3">
    <?php echo Form::label('Check-in', 'check_in', ['class' => 'form-label']); ?>
    <?php echo Form::input('check_in', Input::post('check_in', $booking->check_in), ['class' => 'form-control', 'type' => 'date']); ?>
</div>

<div class="mb-3">
    <?php echo Form::label('Check-out', 'check_out', ['class' => 'form-label']); ?>
    <?php echo Form::input('check_out', Input::post('check_out', $booking->check_out), ['class' => 'form-control', 'type' => 'date']); ?>
</div>

<div class="mb-3">
    <?php echo Form::label('Status', 'status', ['class' => 'form-label']); ?>
    <?php echo Form::select('status',
        Input::post('status', $booking->status),
        [
            'pending'     => 'Pending',
            'deposit'     => 'Deposit',
            'checked_in'  => 'Checked In',
            'canceled'    => 'Canceled',
        ],
        ['class' => 'form-select']); ?>
</div>

<div class="mb-3">
    <?php echo Form::label('Note', 'note', ['class' => 'form-label']); ?>
    <?php echo Form::textarea('note', Input::post('note', $booking->note), ['class' => 'form-control']); ?>
</div>

<div class="d-flex gap-2">
    <?php echo Form::submit('submit', 'Lưu thay đổi', ['class' => 'btn btn-success']); ?>
    <a href="<?php echo Uri::create('admin/booking'); ?>" class="btn btn-secondary">Quay lại</a>
</div>

<?php echo Form::close(); ?>
