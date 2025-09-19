<?php

class Controller_Admin_Province extends Controller_Admin_Base
{
    public function action_index()
    {
        $data['provinces'] = Model_Province::find('all');
        $this->template->title = "Quản lý Tỉnh/Thành";
        $this->template->content = View::forge('admin/province/index', $data);
    }

    public function action_view($id = null)
    {
        is_null($id) and Response::redirect('admin/province');

        if ( ! $data['province'] = Model_Province::find($id))
        {
            Session::set_flash('error', 'Không tìm thấy tỉnh/thành #'.$id);
            Response::redirect('admin/province');
        }

        $this->template->title = "Chi tiết Tỉnh/Thành";
        $this->template->content = View::forge('admin/province/view', $data);
    }

    public function action_create()
    {
        if (Input::method() == 'POST')
        {
            $val = Model_Province::validate('create');

            if ($val->run())
            {
                $province = Model_Province::forge(array(
                    'name' => Input::post('name'),
                ));

                if ($province and $province->save())
                {
                    Session::set_flash('success', 'Thêm tỉnh/thành thành công #'.$province->id.'.');
                    Response::redirect('admin/province');
                }
                else
                {
                    Session::set_flash('error', 'Không thể lưu tỉnh/thành.');
                }
            }
            else
            {
                Session::set_flash('error', $val->error());
            }
        }

        $this->template->title = "Thêm mới Tỉnh/Thành";
        $this->template->content = View::forge('admin/province/create');
    }

    public function action_edit($id = null)
    {
        is_null($id) and Response::redirect('admin/province');

        if ( ! $province = Model_Province::find($id))
        {
            Session::set_flash('error', 'Không tìm thấy tỉnh/thành #'.$id);
            Response::redirect('admin/province');
        }

        $val = Model_Province::validate('edit');

        if ($val->run())
        {
            $province->name = Input::post('name');

            if ($province->save())
            {
                Session::set_flash('success', 'Cập nhật thành công #'.$id);
                Response::redirect('admin/province');
            }
            else
            {
                Session::set_flash('error', 'Không thể cập nhật tỉnh/thành #'.$id);
            }
        }
        else
        {
            if (Input::method() == 'POST')
            {
                Session::set_flash('error', $val->error());
            }
        }

        $this->template->set_global('province', $province, false);
        $this->template->title = "Sửa Tỉnh/Thành";
        $this->template->content = View::forge('admin/province/edit');
    }

    public function action_delete($id = null)
    {
        if ($province = Model_Province::find($id))
        {
            $province->delete();
            Session::set_flash('success', 'Xóa thành công #'.$id);
        }
        else
        {
            Session::set_flash('error', 'Không tìm thấy tỉnh/thành #'.$id);
        }

        Response::redirect('admin/province');
    }
}
