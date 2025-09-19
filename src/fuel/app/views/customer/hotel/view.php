<div class="container my-5">
    <div class="card shadow-lg border-0 rounded-3">
        <div class="row g-0">
            <?php if ($hotel->image): ?>
                <div class="col-md-5">
                    <img src="<?php echo Uri::create('uploads/hotels/'.$hotel->image); ?>"
                         alt="<?php echo e($hotel->name); ?>"
                         class="img-fluid rounded-start w-100 h-100 object-fit-cover">
                </div>
            <?php endif; ?>

            <div class="col-md-7">
                <div class="card-body p-4">
                    <h2 class="card-title mb-3 text-primary fw-bold">
                        <?php echo e($hotel->name); ?>
                    </h2>

                    <p class="mb-2">
                        <i class="bi bi-geo-alt-fill text-danger"></i>
                        <strong>Địa chỉ:</strong> <?php echo e($hotel->address); ?>
                    </p>

                    <p class="mb-2">
                        <i class="bi bi-building text-info"></i>
                        <strong>Tỉnh/Thành:</strong>
                        <?php echo $hotel->province ? e($hotel->province->name) : '---'; ?>
                    </p>

                    <p class="mb-4">
                        <i class="bi bi-info-circle text-secondary"></i>
                        <strong>Mô tả:</strong><br>
                        <?php echo nl2br(e($hotel->description)); ?>
                    </p>

                    <a href="<?php echo Uri::create('customer/hotel'); ?>"
                       class="btn btn-outline-secondary">← Quay lại</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Danh sách phòng -->
    <div class="card shadow-sm border-0 rounded-3 mt-5">
        <div class="card-body">
            <h3 class="mb-4 text-success">Danh sách phòng</h3>

            <?php if ($hotel->rooms): ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Số phòng</th>
                                <th>Loại</th>
                                <th>Giá</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($hotel->rooms as $i => $room): ?>
                            <tr>
                                <td><?php echo $i+1; ?></td>
                                <td><?php echo e($room->room_number); ?></td>
                                <td>
                                    <span class="badge bg-info text-dark">
                                        <?php echo e($room->type); ?>
                                    </span>
                                </td>
                                <td><?php echo number_format($room->price); ?> VND</td>
                                <td>
                                    <a href="<?php echo Uri::create('room/'.$room->id); ?>"
                                       class="btn btn-sm btn-primary">
                                        Xem chi tiết
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="text-muted fst-italic">Khách sạn này chưa có phòng nào.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
