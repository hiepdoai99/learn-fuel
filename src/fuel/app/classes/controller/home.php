<?php

class Controller_Home extends Controller_Template
{
    public $template = 'customer/template';

    public function action_index()
    {
        // 9 tỉnh/thành trung tâm hành chính
        $center_provinces = [
            'Hà Nội',
            'Lạng Sơn',
            'Thanh Hoá',
            'Nghệ An',
            'Huế',
            'Đà Nẵng',
            'Khánh Hòa',
            'TP Hồ Chí Minh',
            'Cần Thơ',
        ];

        // Lấy danh sách tỉnh thành kèm số lượng khách sạn (chỉ 9 tỉnh)
        $provinces = DB::select('p.id', 'p.name', DB::expr('COUNT(h.id) as hotel_count'))
            ->from(['provinces', 'p'])
            ->join(['hotels', 'h'], 'LEFT')->on('h.province_id', '=', 'p.id')
            ->where('p.name', 'in', $center_provinces)
            ->group_by('p.id', 'p.name')
            ->execute()
            ->as_array();

        $this->template->title = "Trang chủ";
        $this->template->content = View::forge('customer/home', [
            'provinces' => $provinces
        ]);
    }
    // public function action_mail()
    // {
    //     try {
    //         $email = \Email::forge();

    //         $email->to('nguyenxuanhiep168@gmail.com', 'Khách test');
    //         $email->from('nguyenxuanhiepk49@gmail.com', 'Hotel Booking');
    //         $email->subject('Test gửi mail FuelPHP');
    //         $email->body('Xin chào, đây là email test gửi từ FuelPHP qua Gmail SMTP.');

    //         $email->send();

    //         return "✅ Mail đã gửi thành công!";
    //     } catch (\EmailSendingFailedException $e) {
    //         return "❌ Lỗi gửi mail: " . $e->getMessage();
    //     }
    // }
}
