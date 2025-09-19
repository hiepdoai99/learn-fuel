<?php

class Controller_Customer_Hotel extends Controller_Template
{
    public $template = 'customer/template';

    public function action_index()
    {
        $query = Model_Hotel::query()->related('province');

        // Lọc theo name
        $keyword = \Input::get('q');
        if (!empty($keyword)) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }

        // Lọc theo province_id
        $province_id = \Input::get('province_id');
        if (!empty($province_id)) {
            $query->where('province_id', $province_id);
        }

        $data['hotels'] = $query->get();
        $data['provinces'] = Model_Province::find('all');
        $data['keyword'] = $keyword;
        $data['province_id'] = $province_id;

        $this->template->title = "Danh sách khách sạn";
        $this->template->content = View::forge('customer/hotel/index', $data);
    }

    public function action_view($id = null)
    {
        if ($id === null) {
            \Response::redirect('customer/hotel');
        }

        $hotel = \Model_Hotel::find($id, [
            'related' => ['rooms', 'province']
        ]);

        if (!$hotel) {
            \Response::redirect('customer/hotel');
        }

        $data['hotel'] = $hotel;

        $this->template->title = "Chi tiết khách sạn";
        $this->template->content = \View::forge('customer/hotel/view', $data);
    }
}
