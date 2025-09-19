<?php

class Observer_BookingMail
{
    public static function orm_notify($obj, $event)
    {
        if ($event !== 'after_insert') {
            return;
        }

        $to = isset($obj->user) && $obj->user && !empty($obj->user->email)
              ? $obj->user->email
              : $obj->customer_email;

        if (empty($to)) {
            \Log::warning("Booking #{$obj->id} has no recipient email; skipping mail queue.");
            return;
        }

        $subject = "Xác nhận đặt phòng #{$obj->id}";
        $body = "Xin chào " . ($obj->customer_name ?: 'khách hàng') . ",\n\n"
              . "Cảm ơn bạn đã đặt phòng tại hệ thống chúng tôi.\n"
              . "Mã đặt phòng: {$obj->id}\n"
              . "Check-in: {$obj->check_in}\n"
              . "Check-out: {$obj->check_out}\n\n"
              . "Vui lòng chuyển khoản tiền đặt cọc để hoàn tất đặt phòng.\n\n"
              . "Trân trọng,\nHotel Booking";

        Model_MailQueue::forge([
            'to'         => $to,
            'subject'    => $subject,
            'body'       => $body,
            'status'     => 'pending',
            'created_at' => time(),
        ])->save();
    }
}
