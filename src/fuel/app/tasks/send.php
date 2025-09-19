<?php

namespace Fuel\Tasks;

class Send
{
    public static function mails()
    {
        $mails = \Model_MailQueue::find('all', [
            'where' => [['status', 'pending']],
            'limit' => 10,
        ]);

        foreach ($mails as $mail) {
            try {
                $email = \Email::forge();
                $email->to($mail->to);
                $email->from('no-reply@hotel.com', 'Hotel Booking');
                $email->subject($mail->subject);
                $email->body($mail->body);
                $email->send();

                $mail->status  = 'sent';
                $mail->sent_at = time();
                $mail->save();

                echo "✅ Sent mail to {$mail->to}\n";
            } catch (\Exception $e) {
                $mail->status = 'failed';
                $mail->save();
                echo "❌ Failed to send mail to {$mail->to}: {$e->getMessage()}\n";
            }
        }
    }
}
