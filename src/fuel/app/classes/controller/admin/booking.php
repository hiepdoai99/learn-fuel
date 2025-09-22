<?php

use Service\Booking as BookingService;
class Controller_Admin_Booking extends Controller_Admin_Base
{

    public function action_index()
    {
        $query = Model_Booking::query()
            ->related('room')
            ->related('room.hotel')
            ->related('room.hotel.province');

        $filters = \Input::get();

        if ($name = \Arr::get($filters, 'name')) {
            $query->where('customer_name', 'like', "%$name%");
        }
        if ($email = \Arr::get($filters, 'email')) {
            $query->where('customer_email', 'like', "%$email%");
        }
        if ($phone = \Arr::get($filters, 'phone')) {
            $query->where('customer_phone', 'like', "%$phone%");
        }
        if ($province_id = \Arr::get($filters, 'province_id')) {
            $query->where('room.hotel.province_id', $province_id);
        }
        if ($hotel_id = \Arr::get($filters, 'hotel_id')) {
            $query->where('room.hotel.id', $hotel_id);
        }
        if ($room_id = \Arr::get($filters, 'room_id')) {
            $query->where('room_id', $room_id);
        }
        if ($check_in = \Arr::get($filters, 'check_in')) {
            $query->where('check_in', '>=', $check_in);
        }
        if ($check_out = \Arr::get($filters, 'check_out')) {
            $query->where('check_out', '<=', $check_out);
        }

        $query->order_by('id', 'desc');

        $total_items = $query->count();

        $pager_params = \Input::get();
        unset($pager_params['page']);

        $pagination_url = \Uri::current() . '?' . http_build_query($pager_params);

        $config = [
            'pagination_url' => $pagination_url,
            'total_items' => $total_items,
            'per_page' => 10,
            'uri_segment' => 'page', 
            'uri_segment_for_get_params' => true, 
        ];

        $pager = \Pagination::forge('bookings', $config);

        $data['bookings'] = $query
            ->rows_offset($pager->offset)
            ->rows_limit($pager->per_page)
            ->get();

        $data['pager_html'] = $pager->render();

        $this->template->title = "Bookings";
        $this->template->content = \View::forge('admin/booking/index', $data);
    }



    public function action_view($id = null)
    {
        is_null($id) and Response::redirect('admin/booking');

        if (!$data['booking'] = Model_Booking::find($id)) {
            Session::set_flash('error', 'Không tìm thấy booking #' . $id);
            Response::redirect('admin/booking');
        }

        $this->template->title = "Chi tiết booking";
        $this->template->content = View::forge('admin/booking/view', $data);
    }

    public function action_create()
    {
        // load danh sách tỉnh
        $provinces = Model_Province::find('all', [
            'order_by' => ['name' => 'asc']
        ]);

        if (\Input::method() == 'POST') {
            $val = \Validation::forge();
            $val->add('room_id', 'Room')->add_rule('required');
            $val->add('check_in', 'Check in')->add_rule('required');
            $val->add('check_out', 'Check out')->add_rule('required');

            // thông tin khách
            $val->add('customer_name', 'Tên khách hàng')->add_rule('required');
            $val->add('customer_email', 'Email')->add_rule('required')->add_rule('valid_email');
            $val->add('customer_phone', 'Số điện thoại')->add_rule('required');
            $val->add('note', 'Ghi chú');

            if ($val->run()) {
                $room_id = Input::post('room_id');
                $check_in = Input::post('check_in');
                $check_out = Input::post('check_out');

                // lấy user_id từ admin đăng nhập
                $user_id = \Session::get('user_id');

                if (!BookingService::isRoomAvailable($room_id, $check_in, $check_out)) {
                    \Session::set_flash('error', 'Phòng này đã được đặt trong thời gian bạn chọn.');
                } else {
                    $booking = BookingService::createBooking([
                        'room_id' => $room_id,
                        'user_id' => $user_id,
                        'check_in' => $check_in,
                        'check_out' => $check_out,
                        'customer_name' => Input::post('customer_name'),
                        'customer_email' => Input::post('customer_email'),
                        'customer_phone' => Input::post('customer_phone'),
                        'note' => Input::post('note'),
                        'status' => 'pending',
                    ]);

                    if ($booking) {
                        \Session::set_flash('success', 'Admin đã tạo booking thành công.');
                    } else {
                        \Session::set_flash('error', 'Không thể tạo booking.');
                    }
                }
            } else {
                \Session::set_flash('error', $val->show_errors());
            }
        }

        $this->template->title = 'Tạo Booking (Admin)';
        $this->template->content = \View::forge('admin/booking/create', [
            'provinces' => $provinces,
        ]);
    }

    public function action_edit($id = null)
    {
        is_null($id) and Response::redirect('admin/booking');

        if (!$booking = Model_Booking::find($id)) {
            Session::set_flash('error', 'Không tìm thấy booking #' . $id);
            Response::redirect('admin/booking');
        }

        if (Input::method() == 'POST') {
            // giữ nguyên room_id nếu không thay đổi trong form
            $booking->user_id = Input::post('user_id') ?: null;
            $booking->room_id = Input::post('room_id', $booking->room_id);
            $booking->check_in = Input::post('check_in');
            $booking->check_out = Input::post('check_out');
            $booking->status = Input::post('status');

            // thêm các field mới
            $booking->customer_name = Input::post('customer_name');
            $booking->customer_email = Input::post('customer_email');
            $booking->customer_phone = Input::post('customer_phone');
            $booking->note = Input::post('note');

            if ($booking->save()) {
                Session::set_flash('success', 'Cập nhật booking thành công.');
                Response::redirect('admin/booking');
            } else {
                Session::set_flash('error', 'Không thể cập nhật booking.');
            }
        }

        $data['booking'] = $booking;
        $this->template->title = "Sửa booking";
        $this->template->content = View::forge('admin/booking/edit', $data);
    }


    public function action_delete($id = null)
    {
        if ($booking = Model_Booking::find($id)) {
            $booking->delete();
            Session::set_flash('success', 'Đã xóa booking #' . $id);
        } else {
            Session::set_flash('error', 'Không tìm thấy booking #' . $id);
        }

        Response::redirect('admin/booking');
    }
}
