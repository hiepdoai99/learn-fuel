<?php

use Service\Booking as BookingService;
class Controller_Admin_Booking extends Controller_Admin_Base
{

    public function action_index()
    {

        $query = Model_Booking::query()
            ->related('room')       // load room trước
            ->related('room.hotel'); // rồi mới load hotel

        // Lọc theo keyword
        $keyword = Input::get('q');
        if ($keyword) {
            $query->where_open()
                ->where('customer_name', 'like', "%$keyword%")
                ->or_where('customer_email', 'like', "%$keyword%")
                ->or_where('customer_phone', 'like', "%$keyword%")
                ->or_where('room.hotel.name', 'like', "%$keyword%")
                ->where_close();
        }

        $data['bookings'] = $query->get();

        $this->template->title = "Bookings";
        $this->template->content = View::forge('admin/booking/index', $data);
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
