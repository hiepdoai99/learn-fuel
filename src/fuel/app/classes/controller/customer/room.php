<?php

class Controller_Customer_Room extends Controller_Template
{
    public $template = 'customer/template';

    public function action_view($id = null)
    {
        if ($id === null) {
            \Response::redirect('customer/hotel');
        }

        // Get room with hotel and images
        $room = \Model_Room::find($id, [
            'related' => ['hotel', 'images']
        ]);

        if (!$room) {
            \Response::redirect('customer/hotel');
        }

        $data['room'] = $room;

        $this->template->title = "Room detail";
        $this->template->content = \View::forge('customer/room/view', $data);
    }

    public function action_booking($room_id = null)
    {
        if (\Input::method() == 'POST') {
            $booking = \Model_Booking::forge(array(
                'room_id' => $room_id,
                'user_id' => null,
                'check_in' => \Input::post('check_in'),
                'check_out' => \Input::post('check_out'),
                'customer_name' => \Input::post('customer_name'),
                'customer_email' => \Input::post('customer_email'),
                'customer_phone' => \Input::post('customer_phone'),
                'note' => \Input::post('note'),
                'status' => 'pending',
            ));

            if ($booking and $booking->save()) {
                \Session::set_flash('success', 'Booking created successfully!');
            } else {
                \Session::set_flash('error', 'Could not create booking.');
            }

            // load lại trang chi tiết phòng (giữ nguyên view)
            $room = \Model_Room::find($room_id, [
                'related' => ['hotel', 'images']
            ]);

            if (!$room) {
                \Response::redirect('customer/hotel');
            }

            $data['room'] = $room;
            $this->template->title = "Room detail";
            $this->template->content = \View::forge('customer/room/view', $data);
        } else {
            \Response::redirect('customer/room/view/' . $room_id);
        }
    }

}
