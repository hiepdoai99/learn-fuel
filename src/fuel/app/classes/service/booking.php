<?php

namespace Service;

use Model_Booking;

class Booking
{
    /**
     * Kiểm tra phòng còn trống trong khoảng ngày
     */
    public static function isRoomAvailable($room_id, $check_in, $check_out)
    {
        return !Model_Booking::query()
            ->where('room_id', $room_id)
            ->where('status', 'confirmed')
            ->and_where_open()
                ->where('check_in', '<', $check_out)
                ->where('check_out', '>', $check_in)
            ->and_where_close()
            ->get_one();
    }

    /**
     * Tạo booking mới
     */
    public static function createBooking($data)
    {
        $booking = Model_Booking::forge($data);
        return $booking->save() ? $booking : false;
    }
}
