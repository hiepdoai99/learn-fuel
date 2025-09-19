<?php
class Controller_Customer_Province extends Controller_Template
{
    public $template = 'customer/template';

    public function action_index()
    {
        $query = Model_Province::query();

        // Nếu có từ khóa tìm kiếm
        $keyword = Input::get('q');
        if ($keyword) {
            $query->where('name', 'like', '%'.$keyword.'%');
        }

        $provinces = $query->order_by('name', 'asc')->get();

        // Đếm số khách sạn theo từng tỉnh
        foreach ($provinces as $province) {
            $province->hotel_count = Model_Hotel::query()
                ->where('province_id', $province->id)
                ->count();
        }

        $this->template->title = 'Danh sách tỉnh thành';
        $this->template->content = View::forge('customer/province/index', [
            'provinces' => $provinces,
            'keyword'   => $keyword,
        ]);
    }
}
