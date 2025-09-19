<div class="container py-5">
    <h2 class="mb-4 text-center fw-bold">Danh sách tỉnh thành</h2>

    <!-- Form tìm kiếm -->
    <form method="get" class="row justify-content-center mb-5">
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Tìm theo tên tỉnh..."
                    value="<?= isset($keyword) ? $keyword : '' ?>">
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </div>
        </div>
    </form>

    <div class="row g-4">
        <?php if ($provinces): ?>
            <?php foreach ($provinces as $province): ?>
                <div class="col-md-4 col-lg-3">
                    <div class="card shadow-sm border-0 h-100 hover-card">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold"><?= $province->name; ?></h5>
                            <p class="text-muted mb-3"><?= count($province->hotels); ?> khách sạn</p>
                            <a href="<?php echo Uri::create('/hotel?province_id=' . $province->id); ?>"
                                class="btn btn-outline-primary btn-sm">
                                Xem khách sạn
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-muted">Không tìm thấy tỉnh thành nào.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Thêm chút CSS cho đẹp hơn -->
<style>
    .hover-card {
        transition: all 0.3s ease;
    }

    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15) !important;
    }
</style>