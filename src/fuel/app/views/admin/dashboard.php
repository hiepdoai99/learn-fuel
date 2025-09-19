<h1>📊 Dashboard</h1>
<p>Chào mừng bạn đến trang quản trị hệ thống khách sạn.</p>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-bg-info mb-3">
            <div class="card-body">
                <h5 class="card-title"><?php echo $province_count; ?></h5>
                <p class="card-text">Tỉnh thành có khách sạn</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title"><?php echo $hotel_count; ?></h5>
                <p class="card-text">Tổng số khách sạn</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title"><?php echo $room_count; ?></h5>
                <p class="card-text">Số phòng</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-bg-warning mb-3">
            <div class="card-body">
                <h5 class="card-title"><?php echo $booking_count; ?></h5>
                <p class="card-text">Tổng số booking</p>
            </div>
        </div>
    </div>
</div>

