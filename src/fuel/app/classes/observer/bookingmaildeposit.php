<?php

class Observer_BookingMailDeposit
{
    public static function orm_notify($obj, $event)
    {

        if ($event !== 'after_update') {
            return;
        }

        if (empty($obj->status) || strtolower($obj->status) !== 'deposit') {
            return;
        }

        $to = isset($obj->user) && $obj->user && !empty($obj->user->email)
              ? $obj->user->email
              : $obj->customer_email;

        if (empty($to)) {
            \Log::warning("Booking #{$obj->id} deposit confirmed but no email found.");
            return;
        }

        $subject = "Xác nhận nhận cọc - Booking #{$obj->id}";
        $body = "Xin chào " . ($obj->customer_name ?: 'khách hàng') . ",\n\n"
              . "Chúng tôi đã nhận được tiền đặt cọc cho booking của bạn.\n"
              . "Mã đặt phòng: {$obj->id}\n"
              . "Ngày nhận phòng: {$obj->check_in}\n\n"
              . "Booking của bạn đã được xác nhận.\n\nTrân trọng,\nHotel Booking";

        Model_MailQueue::forge([
            'to'         => $to,
            'subject'    => $subject,
            'body'       => $body,
            'status'     => 'pending',
            'created_at' => time(),
        ])->save();
    }
}
