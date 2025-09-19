<div class="row">
    <div class="col-12">
        <h1 class="mb-4">Danh sách tỉnh thành</h1>
    </div>

    <?php foreach ($provinces as $province): ?>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $province['name']; ?></h5>
                    <p class="card-text">
                        <strong><?php echo $province['hotel_count']; ?></strong> khách sạn
                    </p>
                    <a href="/customer/hotel/index?province_id=<?php echo $province['id']; ?>" class="btn btn-primary">
                        Xem khách sạn
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
