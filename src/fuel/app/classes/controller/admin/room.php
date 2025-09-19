<?php

class Controller_Admin_Room extends Controller_Admin_Base
{
    // Danh sách phòng
    public function action_index()
    {
        $data['rooms'] = Model_Room::find('all', ['related' => ['hotel', 'images']]);
        $this->template->title = "Danh sách phòng";
        $this->template->content = View::forge('admin/room/index', $data);
    }

    // Xem chi tiết
    public function action_view($id = null)
    {
        is_null($id) and Response::redirect('admin/room');

        if (! $data['room'] = Model_Room::find($id, ['related' => ['hotel', 'images']]))
        {
            Session::set_flash('error', 'Không tìm thấy phòng #'.$id);
            Response::redirect('admin/room');
        }

        $this->template->title = "Chi tiết phòng";
        $this->template->content = View::forge('admin/room/view', $data);
    }

    // Tạo phòng
    public function action_create()
    {
        if (Input::method() == 'POST')
        {
            $room = Model_Room::forge(array(
                'hotel_id'    => Input::post('hotel_id'),
                'room_number' => Input::post('room_number'),
                'type'        => Input::post('type'),
                'price'       => Input::post('price'),
            ));

            if ($room and $room->save())
            {
                // Upload nhiều ảnh
                $files = Input::file('images');
                if ($files)
                {
                    Upload::process([
                        'path' => DOCROOT.'uploads/rooms/',
                        'randomize' => true,
                        'ext_whitelist' => ['jpg','jpeg','png','gif'],
                    ]);
                    if (Upload::is_valid()) {
                        Upload::save();
                        foreach (Upload::get_files() as $file) {
                            $img = Model_RoomImage::forge([
                                'room_id' => $room->id,
                                'image'   => $file['saved_as'],
                            ]);
                            $img->save();
                        }
                    }
                }

                Session::set_flash('success', 'Thêm phòng mới thành công.');
                Response::redirect('admin/room');
            }
            else
            {
                Session::set_flash('error', 'Không thể tạo phòng.');
            }
        }

        $data['hotels'] = Model_Hotel::find('all');
        $data['types']  = Model_Room::room_types();

        $this->template->title = "Tạo phòng";
        $this->template->content = View::forge('admin/room/create', $data);
    }

    // Sửa phòng
    public function action_edit($id = null)
    {
        is_null($id) and Response::redirect('admin/room');

        if (! $room = Model_Room::find($id, ['related' => ['images']]))
        {
            Session::set_flash('error', 'Không tìm thấy phòng #'.$id);
            Response::redirect('admin/room');
        }

        if (Input::method() == 'POST')
        {
            $room->hotel_id    = Input::post('hotel_id');
            $room->room_number = Input::post('room_number');
            $room->type        = Input::post('type');
            $room->price       = Input::post('price');

            if ($room->save())
            {
                // Upload thêm ảnh
                $files = Input::file('images');
                if ($files)
                {
                    Upload::process([
                        'path' => DOCROOT.'uploads/rooms/',
                        'randomize' => true,
                        'ext_whitelist' => ['jpg','jpeg','png','gif'],
                    ]);
                    if (Upload::is_valid()) {
                        Upload::save();
                        foreach (Upload::get_files() as $file) {
                            $img = Model_RoomImage::forge([
                                'room_id' => $room->id,
                                'image'   => $file['saved_as'],
                            ]);
                            $img->save();
                        }
                    }
                }

                Session::set_flash('success', 'Cập nhật thành công.');
                Response::redirect('admin/room');
            }
            else
            {
                Session::set_flash('error', 'Không thể cập nhật.');
            }
        }

        $data['room']   = $room;
        $data['hotels'] = Model_Hotel::find('all');
        $data['types']  = Model_Room::room_types();

        $this->template->title = "Sửa phòng";
        $this->template->content = View::forge('admin/room/create', $data);
    }

    // Xóa phòng
    public function action_delete($id = null)
    {
        if ($room = Model_Room::find($id, ['related' => ['images']]))
        {
            // Xóa file vật lý
            foreach ($room->images as $img) {
                $path = DOCROOT.'uploads/rooms/'.$img->image;
                if (file_exists($path)) unlink($path);
            }
            $room->delete();

            Session::set_flash('success', 'Đã xóa phòng #'.$id);
        }
        else
        {
            Session::set_flash('error', 'Không tìm thấy phòng #'.$id);
        }

        Response::redirect('admin/room');
    }
}
