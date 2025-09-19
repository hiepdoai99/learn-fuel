<?php

use Service\Booking as BookingService;

class Controller_Customer_Booking extends Controller_Template
{
    public $template = 'customer/template';
    public function action_create()
    {
        // load danh sách tỉnh để khách chọn trước
        $provinces = Model_Province::find('all', [
            'order_by' => ['name' => 'asc']
        ]);

        if (Input::method() == 'POST') {
            $val = Validation::forge();
            $val->add('room_id', 'Room')->add_rule('required');
            $val->add('check_in', 'Check in')->add_rule('required');
            $val->add('check_out', 'Check out')->add_rule('required');

            // validate thông tin khách
            $val->add('customer_name', 'Tên khách hàng')->add_rule('required');
            $val->add('customer_email', 'Email')->add_rule('required')->add_rule('valid_email');
            $val->add('customer_phone', 'Số điện thoại')->add_rule('required');
            $val->add('note', 'Ghi chú'); // optional

            if ($val->run()) {
                $room_id = Input::post('room_id');
                $check_in = Input::post('check_in');
                $check_out = Input::post('check_out');

                // check phòng có khả dụng không
                if (!BookingService::isRoomAvailable($room_id, $check_in, $check_out)) {
                    Session::set_flash('error', 'Phòng này đã được đặt trong thời gian bạn chọn.');
                } else {
                    // tạo booking mới
                    $booking = BookingService::createBooking([
                        'room_id' => $room_id,
                        'user_id' => null,
                        'check_in' => $check_in,
                        'check_out' => $check_out,
                        'customer_name' => Input::post('customer_name'),
                        'customer_email' => Input::post('customer_email'),
                        'customer_phone' => Input::post('customer_phone'),
                        'note' => Input::post('note'),
                        'status' => 'pending',
                    ]);

                    if ($booking) {
                        Session::set_flash('success', 'Đặt phòng thành công, vui lòng chờ xác nhận.');
                    } else {
                        Session::set_flash('error', 'Không thể tạo booking.');
                    }
                }
            } else {
                Session::set_flash('error', $val->show_errors());
            }
        }

        // luôn render lại view form (không redirect)
        $this->template->title = 'Tạo Booking';
        $this->template->content = View::forge('customer/booking/create', [
            'provinces' => $provinces,
        ]);
    }


}
