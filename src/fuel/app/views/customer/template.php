<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title><?php echo $title ?? 'HotelBooking'; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
            background: url('https://decoxdesign.com/upload/images/mau-khach-san-5-sao-05-decox-design.jpg') no-repeat center center;
            background-size: cover;
            /* để ảnh full màn hình */
            padding: 40px;
        }

        .overlay {
            background: rgba(255, 255, 255, 0.85);
            /* nền trắng mờ để chữ dễ đọc */
            border-radius: 12px;
            padding: 20px;
        }

        footer {
            background: #212529;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <header class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">THK Holdings</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/province">Danh sách tỉnh thành</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/hotel">Khách sạn</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="/booking" class="btn btn-warning">Booking Now</a>
                </div>
            </div>
        </div>
    </header>


    <main>
        <?php if (Session::get_flash('success')): ?>
            <div class="alert alert-success">
                <?php echo Session::get_flash('success'); ?>
            </div>
        <?php endif; ?>

        <?php if (Session::get_flash('error')): ?>
            <div class="alert alert-danger">
                <?php echo Session::get_flash('error'); ?>
            </div>
        <?php endif; ?>

        <div class="container overlay">
            <?php echo $content; ?>
        </div>
    </main>

    <footer>
        © 2025 HotelBooking Demo
    </footer>
</body>

</html>