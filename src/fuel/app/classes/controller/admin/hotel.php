<?php

class Controller_Admin_Hotel extends Controller_Admin_Base
{
    public function action_index()
    {
        $data['hotels'] = Model_Hotel::find('all');
        $this->template->title = "Danh sách khách sạn";
        $this->template->content = View::forge('admin/hotel/index', $data);
    }

    public function action_view($id = null)
    {
        is_null($id) and Response::redirect('admin/hotel');

        if (!$data['hotel'] = Model_Hotel::find($id)) {
            Session::set_flash('error', 'Không tìm thấy khách sạn #' . $id);
            Response::redirect('admin/hotel');
        }

        $this->template->title = "Chi tiết khách sạn";
        $this->template->content = View::forge('admin/hotel/view', $data);
    }

    // public function action_create()
    // {
    //     if (Input::method() == 'POST') {
    //         // Xử lý upload ảnh
    //         $file = Input::file('image');
    //         $image_name = null;

    //         if ($file and $file['size'] > 0) {
    //             $config = [
    //                 'path' => DOCROOT . 'uploads/hotels/',
    //                 'randomize' => true,
    //                 'ext_whitelist' => ['jpg', 'jpeg', 'png', 'gif', 'webp'],
    //             ];

    //             Upload::process($config);

    //             if (Upload::is_valid()) {
    //                 Upload::save();
    //                 $files = Upload::get_files();
    //                 $image_name = $files[0]['saved_as'];
    //             } else {
    //                 Session::set_flash('error', 'Upload ảnh thất bại.');
    //             }
    //         }

    //         $hotel = Model_Hotel::forge([
    //             'name' => Input::post('name'),
    //             'address' => Input::post('address'),
    //             'description' => Input::post('description'),
    //             'province_id' => Input::post('province_id'),
    //             'image' => $image_name,
    //         ]);

    //         if ($hotel and $hotel->save()) {
    //             Session::set_flash('success', 'Thêm khách sạn thành công.');
    //             Response::redirect('admin/hotel');
    //         } else {
    //             Session::set_flash('error', 'Không thể tạo khách sạn.');
    //         }
    //     }

    //     $data['provinces'] = \Arr::assoc_to_keyval(Model_Province::find('all'), 'id', 'name');

    //     $this->template->title = "Thêm khách sạn";
    //     $this->template->content = View::forge('admin/hotel/create', $data);
    // }

    public function action_create()
    {
        if (\Input::method() == 'POST') {
            // Lấy file upload
            $file = \Input::file('image');
            $image_tmp = null;

            if ($file and $file['size'] > 0) {
                $config = [
                    'path' => DOCROOT . 'uploads/tmp/',
                    'randomize' => true,
                    'ext_whitelist' => ['jpg', 'jpeg', 'png', 'gif', 'webp'],
                ];

                \Upload::process($config);

                if (\Upload::is_valid()) {
                    \Upload::save();
                    $files = \Upload::get_files();
                    $image_tmp = $files[0]['saved_as'];
                } else {
                    \Session::set_flash('error', 'Upload ảnh thất bại.');
                }
            }

            $hotel = \Model_Hotel::forge([
                'name' => \Input::post('name'),
                'address' => \Input::post('address'),
                'description' => \Input::post('description'),
                'province_id' => \Input::post('province_id'),
                'image' => null, // sẽ xử lý qua queue
            ]);

            if ($hotel and $hotel->save()) {
                // Nếu có ảnh upload thì đưa vào queue xử lý nền
                if ($image_tmp) {
                    \Model_JobQueue::forge([
                        'type' => 'hotel_image_upload',
                        'payload' => json_encode([
                            'hotel_id' => $hotel->id,
                            'file_tmp' => $image_tmp,
                        ]),
                        'status' => 'pending',
                        'attempts' => 0,
                        'created_at' => time(),
                    ])->save();
                }

                \Session::set_flash('success', 'Thêm khách sạn thành công. (Ảnh sẽ được xử lý nền)');
                \Response::redirect('admin/hotel');
            } else {
                \Session::set_flash('error', 'Không thể tạo khách sạn.');
            }
        }

        $data['provinces'] = \Arr::assoc_to_keyval(\Model_Province::find('all'), 'id', 'name');
        $this->template->title = "Thêm khách sạn";
        $this->template->content = \View::forge('admin/hotel/create', $data);
    }



    public function action_edit($id = null)
    {
        is_null($id) and Response::redirect('admin/hotel');

        if (!$hotel = Model_Hotel::find($id)) {
            Session::set_flash('error', 'Không tìm thấy khách sạn #' . $id);
            Response::redirect('admin/hotel');
        }

        if (Input::method() == 'POST') {
            $hotel->name = Input::post('name');
            $hotel->address = Input::post('address');
            $hotel->description = Input::post('description');
            $hotel->province_id = Input::post('province_id');

            // Xử lý upload ảnh mới
            $file = Input::file('image');
            if ($file and $file['size'] > 0) {
                $config = [
                    'path' => DOCROOT . 'uploads/hotels/',
                    'randomize' => true,
                    'ext_whitelist' => ['jpg', 'jpeg', 'png', 'gif'],
                ];
                Upload::process($config);

                if (Upload::is_valid()) {
                    Upload::save();
                    $files = Upload::get_files();
                    $hotel->image = $files[0]['saved_as'];
                } else {
                    Session::set_flash('error', 'Upload ảnh thất bại.');
                }
            }

            if ($hotel->save()) {
                Session::set_flash('success', 'Cập nhật khách sạn thành công.');
                Response::redirect('admin/hotel');
            } else {
                Session::set_flash('error', 'Không thể cập nhật.');
            }
        }

        $data['hotel'] = $hotel;
        $data['provinces'] = \Arr::assoc_to_keyval(Model_Province::find('all'), 'id', 'name');

        $this->template->title = "Sửa khách sạn";
        $this->template->content = View::forge('admin/hotel/edit', $data);
    }

    public function action_delete($id = null)
    {
        if ($hotel = Model_Hotel::find($id)) {
            $hotel->delete();
            Session::set_flash('success', 'Đã xóa khách sạn #' . $id);
        } else {
            Session::set_flash('error', 'Không tìm thấy khách sạn #' . $id);
        }

        Response::redirect('admin/hotel');
    }
}
