<?php
class Controller_Admin_Dashboard extends Controller_Admin_Base
{
    public function action_index()
    {
        $hotel_count   = Model_Hotel::count();
        $room_count    = Model_Room::count();
        $booking_count = Model_Booking::count();

        $province_count = \DB::select(\DB::expr('COUNT(DISTINCT province_id) as count'))
            ->from('hotels')
            ->execute()
            ->get('count');

        $data = [
            'hotel_count'    => $hotel_count,
            'room_count'     => $room_count,
            'booking_count'  => $booking_count,
            'province_count' => $province_count,
        ];

        $this->template->content = View::forge('admin/dashboard', $data);
    }
}
