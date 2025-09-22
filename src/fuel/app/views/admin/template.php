<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Admin - Hotel Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: row;
            background-color: #f8f9fa;
        }

        .sidebar {
            width: 250px;
            background: #343a40;
            color: #fff;
            flex-shrink: 0;
        }

        .sidebar .nav-link {
            color: #adb5bd;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background-color: #495057;
            color: #fff;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
        }

        .sidebar .brand {
            font-size: 1.3rem;
            font-weight: bold;
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #495057;
        }

        .pagination {
            display: flex;
            list-style: none;
            padding-left: 0;
            gap: 4px;
        }

        .pagination span {
            display: inline-block;
        }

        .pagination a {
            display: block;
            padding: 6px 12px;
            text-decoration: none;
            border: 1px solid #dee2e6;
            color: #007bff;
            background-color: #fff;
            border-radius: 4px;
            transition: all 0.2s;
        }

        .pagination a:hover {
            background-color: #e9ecef;
            text-decoration: none;
        }

        .pagination .active a {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
            cursor: default;
        }

        .pagination .previous-inactive a,
        .pagination .next-inactive a {
            color: #6c757d;
            pointer-events: none;
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column p-3">
        <div class="brand">Admin Panel</div>
        <ul class="nav nav-pills flex-column mb-auto">
            <li><a href="<?php echo Uri::create('admin/dashboard'); ?>"
                    class="nav-link <?php echo Uri::segment(2) == 'dashboard' ? 'active' : ''; ?>">📊 Dashboard</a></li>
            <li><a href="<?php echo Uri::create('admin/hotel'); ?>"
                    class="nav-link <?php echo Uri::segment(2) == 'hotel' ? 'active' : ''; ?>">🏨 Khách sạn</a></li>
            <li><a href="<?php echo Uri::create('admin/room'); ?>"
                    class="nav-link <?php echo Uri::segment(2) == 'room' ? 'active' : ''; ?>">🛏️ Phòng</a></li>
            <li><a href="<?php echo Uri::create('admin/booking'); ?>"
                    class="nav-link <?php echo Uri::segment(2) == 'booking' ? 'active' : ''; ?>">📑 Đặt phòng</a></li>
            <li><a href="<?php echo Uri::create('admin/user'); ?>"
                    class="nav-link <?php echo Uri::segment(2) == 'user' ? 'active' : ''; ?>">👤 Người dùng</a></li>
        </ul>

        <div class="mt-auto">
            <a href="<?php echo Uri::create('admin/logout'); ?>" class="nav-link text-danger fw-bold">
                🚪 Đăng xuất
            </a>
        </div>
    </div>

    <!-- Content -->
    <div class="content">
        <?php if (Session::get_flash('success')): ?>
            <div class="alert alert-success mt-3">
                <strong>Success</strong>
                <p><?php echo implode('</p><p>', e((array) Session::get_flash('success'))); ?></p>
            </div>
        <?php endif; ?>

        <?php if (Session::get_flash('error')): ?>
            <div class="alert alert-danger mt-3">
                <strong>Error</strong>
                <p><?php echo implode('</p><p>', e((array) Session::get_flash('error'))); ?></p>
            </div>
        <?php endif; ?>
        <?php echo $content; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>