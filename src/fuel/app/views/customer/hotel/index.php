<div class="container py-5">
    <h2 class="mb-4 text-center fw-bold">Danh sách khách sạn</h2>

    <!-- Form tìm kiếm + lọc -->
    <form method="get" class="row justify-content-center mb-5 g-2">
        <div class="col-md-4">
            <input type="text" name="q" class="form-control" placeholder="Tìm theo tên khách sạn..."
                value="<?= isset($keyword) ? $keyword : '' ?>">
        </div>
        <div class="col-md-3">
            <select name="province_id" class="form-select">
                <option value="">-- Tất cả tỉnh thành --</option>
                <?php foreach ($provinces as $province): ?>
                    <option value="<?= $province->id ?>" <?= (!empty($province_id) && $province_id == $province->id) ? 'selected' : '' ?>>
                        <?= $province->name ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Lọc</button>
        </div>
    </form>

    <div class="row g-4">
        <?php if ($hotels): ?>
            <?php foreach ($hotels as $hotel): ?>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100 hover-card">
                        <?php if ($hotel->image): ?>
                            <img src="<?php echo Uri::create('uploads/hotels/' . $hotel->image); ?>" class="card-img-top"
                                alt="<?= $hotel->name ?>" style="max-height:200px; object-fit:cover;">
                        <?php else: ?>
                            <img src="https://via.placeholder.com/400x250?text=No+Image" class="card-img-top" alt="No image">
                        <?php endif; ?>

                        <div class="card-body">
                            <h5 class="card-title fw-bold"><?= $hotel->name ?></h5>
                            <p class="text-muted mb-1"><?= $hotel->address ?></p>
                            <p class="small text-secondary">Tỉnh: <?= $hotel->province ? $hotel->province->name : 'N/A' ?></p>
                            <a href="/customer/hotel/view/<?= $hotel->id ?>" class="btn btn-outline-primary btn-sm">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-muted">Không tìm thấy khách sạn nào.</p>
        <?php endif; ?>
    </div>
</div>

<style>
    .hover-card {
        transition: all 0.3s ease;
    }

    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15) !important;
    }
</style>