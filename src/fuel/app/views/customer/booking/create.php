<h2>Đặt phòng ngay</h2>

<form method="post">
    <!-- Province -->
    <div class="mb-3">
        <label>Tỉnh/Thành</label>
        <select id="province" name="province_id" class="form-select" required>
            <option value="">-- Chọn tỉnh/thành --</option>
            <?php foreach ($provinces as $province): ?>
                <option value="<?php echo $province->id; ?>">
                    <?php echo e($province->name); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Hotel -->
    <div class="mb-3">
        <label>Khách sạn</label>
        <select id="hotel" name="hotel_id" class="form-select" disabled required>
            <option value="">-- Chọn khách sạn --</option>
        </select>
    </div>

    <!-- Room -->
    <div class="mb-3">
        <label>Phòng</label>
        <select id="room" name="room_id" class="form-select" disabled required>
            <option value="">-- Chọn phòng --</option>
        </select>
    </div>

    <!-- Customer Info -->
    <div class="mb-3">
        <label>Họ tên khách hàng</label>
        <input type="text" name="customer_name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="customer_email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Số điện thoại</label>
        <input type="text" name="customer_phone" class="form-control" required>
    </div>

    <!-- Checkin/out -->
    <div class="row">
        <div class="col">
            <label>Check-in</label>
            <input type="date" name="check_in" class="form-control" required>
        </div>
        <div class="col">
            <label>Check-out</label>
            <input type="date" name="check_out" class="form-control" required>
        </div>
    </div>

    <!-- Note -->
    <div class="mb-3 mt-3">
        <label>Ghi chú</label>
        <textarea name="note" class="form-control" rows="3" placeholder="Nhập yêu cầu đặc biệt nếu có..."></textarea>
    </div>

    <div class="mt-3">
        <button type="submit" class="btn btn-primary">Đặt phòng</button>
    </div>
</form>



<script>
const hotelsUrl = "<?php echo Uri::create('api/hotels'); ?>";
const roomsUrl  = "<?php echo Uri::create('api/rooms'); ?>";

const provinceEl = document.getElementById('province');
const hotelEl    = document.getElementById('hotel');
const roomEl     = document.getElementById('room');

provinceEl.addEventListener('change', function() {
    const provinceId = this.value;
    hotelEl.innerHTML = '<option value="">-- Chọn khách sạn --</option>';
    roomEl.innerHTML  = '<option value="">-- Chọn phòng --</option>';
    roomEl.disabled = true;

    if (!provinceId) {
        hotelEl.disabled = true;
        return;
    }

    hotelEl.disabled = true; // tạm khoá đến khi fetch xong
    fetch(hotelsUrl + '?province_id=' + encodeURIComponent(provinceId))
        .then(res => {
            if (!res.ok) throw new Error('Network response was not ok');
            return res.json();
        })
        .then(data => {
            // data là mảng
            if (!Array.isArray(data) || data.length === 0) {
                hotelEl.innerHTML += '<option value="">(Không có hotel)</option>';
                hotelEl.disabled = true;
                return;
            }
            data.forEach(hot => {
                const opt = document.createElement('option');
                opt.value = hot.id;
                opt.textContent = hot.name;
                hotelEl.appendChild(opt);
            });
            hotelEl.disabled = false;
            console.log('hotels loaded', data);
        })
        .catch(err => {
            console.error('Error fetching hotels:', err);
            alert('Lỗi khi tải danh sách khách sạn. Vui lòng thử lại.');
            hotelEl.disabled = true;
        });
});

hotelEl.addEventListener('change', function() {
    const hotelId = this.value;
    roomEl.innerHTML = '<option value="">-- Chọn phòng --</option>';

    if (!hotelId) {
        roomEl.disabled = true;
        return;
    }

    roomEl.disabled = true;
    fetch(roomsUrl + '?hotel_id=' + encodeURIComponent(hotelId))
        .then(res => {
            if (!res.ok) throw new Error('Network response was not ok');
            return res.json();
        })
        .then(data => {
            if (!Array.isArray(data) || data.length === 0) {
                roomEl.innerHTML += '<option value="">(Không có phòng)</option>';
                roomEl.disabled = true;
                return;
            }
            data.forEach(r => {
                const opt = document.createElement('option');
                opt.value = r.id;
                opt.textContent = 'Phòng ' + r.room_number + ' (' + r.type + ')';
                roomEl.appendChild(opt);
            });
            roomEl.disabled = false;
            console.log('rooms loaded', data);
        })
        .catch(err => {
            console.error('Error fetching rooms:', err);
            alert('Lỗi khi tải danh sách phòng. Vui lòng thử lại.');
            roomEl.disabled = true;
        });
});
</script>
