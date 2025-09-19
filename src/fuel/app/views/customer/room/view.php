<div class="container my-5">
    <!-- Chi tiết phòng -->
    <div class="card shadow-lg border-0 rounded-3 mb-5">
        <div class="row g-0">
            <?php if ($room->images): ?>
                <div class="col-md-6">
                    <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php $active = 'active'; ?>
                            <?php foreach ($room->images as $img): ?>
                                <div class="carousel-item <?php echo $active; ?>">
                                    <img src="<?php echo Uri::create('uploads/rooms/'.$img->image); ?>"
                                         class="d-block w-100 rounded"
                                         alt="Room Image"
                                         style="max-height: 400px; object-fit: cover;">
                                </div>
                                <?php $active = ''; ?>
                            <?php endforeach; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                </div>
            <?php endif; ?>

            <div class="col-md-6">
                <div class="card-body p-4">
                    <h2 class="card-title text-primary fw-bold mb-3">
                        Phòng <?php echo e($room->room_number); ?>
                    </h2>

                    <p class="mb-2"><strong>Loại:</strong> 
                        <span class="badge bg-info text-dark"><?php echo e($room->type); ?></span>
                    </p>
                    <p class="mb-2"><strong>Giá:</strong> 
                        <span class="text-danger fw-bold"><?php echo number_format($room->price); ?> VND</span>
                    </p>

                    <?php if ($room->hotel): ?>
                        <p class="mb-2"><strong>Khách sạn:</strong>
                            <?php echo e($room->hotel->name); ?> - <?php echo e($room->hotel->address); ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Form đặt phòng -->
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body">
            <h3 class="mb-4 text-success">Đặt phòng ngay</h3>

            <?php echo Form::open(['action' => 'customer/room/booking/'.$room->id, 'method' => 'post', 'class' => 'row g-3']); ?>

                <div class="col-md-6">
                    <?php echo Form::label('Ngày nhận phòng', 'check_in', ['class' => 'form-label']); ?>
                    <?php echo Form::input('check_in', Input::post('check_in'), [
                        'type' => 'date', 
                        'class' => 'form-control',
                        'required' => true
                    ]); ?>
                </div>

                <div class="col-md-6">
                    <?php echo Form::label('Ngày trả phòng', 'check_out', ['class' => 'form-label']); ?>
                    <?php echo Form::input('check_out', Input::post('check_out'), [
                        'type' => 'date', 
                        'class' => 'form-control',
                        'required' => true
                    ]); ?>
                </div>

                <div class="col-md-6">
                    <?php echo Form::label('Tên khách hàng', 'customer_name', ['class' => 'form-label']); ?>
                    <?php echo Form::input('customer_name', Input::post('customer_name'), [
                        'class' => 'form-control',
                        'placeholder' => 'Nguyễn Văn A',
                        'required' => true
                    ]); ?>
                </div>

                <div class="col-md-6">
                    <?php echo Form::label('Email', 'customer_email', ['class' => 'form-label']); ?>
                    <?php echo Form::input('customer_email', Input::post('customer_email'), [
                        'type' => 'email',
                        'class' => 'form-control',
                        'placeholder' => 'email@example.com',
                        'required' => true
                    ]); ?>
                </div>

                <div class="col-md-6">
                    <?php echo Form::label('Số điện thoại', 'customer_phone', ['class' => 'form-label']); ?>
                    <?php echo Form::input('customer_phone', Input::post('customer_phone'), [
                        'class' => 'form-control',
                        'placeholder' => '0123456789',
                        'required' => true
                    ]); ?>
                </div>

                <div class="col-md-12">
                    <?php echo Form::label('Ghi chú', 'note', ['class' => 'form-label']); ?>
                    <?php echo Form::textarea('note', Input::post('note'), [
                        'class' => 'form-control',
                        'rows' => 3,
                        'placeholder' => 'Yêu cầu thêm (nếu có)...'
                    ]); ?>
                </div>

                <div class="col-12">
                    <?php echo Form::submit('submit', 'Xác nhận đặt phòng', ['class' => 'btn btn-primary btn-lg']); ?>
                </div>

            <?php echo Form::close(); ?>
        </div>
    </div>
</div>
