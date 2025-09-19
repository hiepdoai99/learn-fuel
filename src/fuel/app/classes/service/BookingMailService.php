<?php

namespace Service;

use Email;

class BookingMailService
{
    /**
     * Gửi mail cho khách khi vừa đặt phòng
     */
    public static function sendBookingCreated($booking)
    {
        $subject = "Xác nhận đặt phòng #" . $booking->id;
        $message = "
            <p>Xin chào {$booking->customer_name},</p>
            <p>Bạn đã đặt phòng thành công tại hệ thống của chúng tôi.</p>
            <p><b>Thông tin đặt phòng:</b></p>
            <ul>
                <li>Phòng: {$booking->room->room_number} ({$booking->room->hotel->name})</li>
                <li>Check-in: {$booking->check_in}</li>
                <li>Check-out: {$booking->check_out}</li>
            </ul>
            <p>Vui lòng chuyển khoản tiền cọc để giữ phòng. Sau khi chúng tôi xác nhận đã nhận cọc, bạn sẽ nhận được mail thông báo.</p>
            <p>Trân trọng.</p>
        ";

        self::sendMail($booking->customer_email, $subject, $message);
    }

    /**
     * Gửi mail khi admin xác nhận đã nhận cọc
     */
    public static function sendDepositedConfirm($booking)
    {
        $subject = "Booking #{$booking->id} đã được xác nhận";
        $message = "
            <p>Xin chào {$booking->customer_name},</p>
            <p>Chúng tôi đã nhận được khoản tiền cọc của bạn.</p>
            <p><b>Thông tin đặt phòng:</b></p>
            <ul>
                <li>Phòng: {$booking->room->room_number} ({$booking->room->hotel->name})</li>
                <li>Check-in: {$booking->check_in}</li>
                <li>Check-out: {$booking->check_out}</li>
            </ul>
            <p>Booking của bạn hiện đã <b>được xác nhận (Deposited)</b>.</p>
            <p>Xin cảm ơn bạn đã tin tưởng dịch vụ của chúng tôi!</p>
        ";

        self::sendMail($booking->customer_email, $subject, $message);
    }

    /**
     * Hàm gửi mail chung
     */
    protected static function sendMail($to, $subject, $html)
    {
        try {
            $email = Email::forge();
            $email->from('no-reply@hotel.local', 'Hotel Booking');
            $email->to($to);
            $email->subject($subject);
            $email->html_body($html);
            $email->send();
        } catch (\EmailValidationFailedException $e) {
            \Log::error('Email validation failed: ' . $e->getMessage());
        } catch (\EmailSendingFailedException $e) {
            \Log::error('Email sending failed: ' . $e->getMessage());
        }
    }
}
 