<?php

class Controller_Admin_Auth extends Controller_Template
{
    public $template = 'template';

    public function action_login()
    {
        if (\Input::method() == 'POST')
        {
            $email    = trim(\Input::post('email'));   // dùng email thay username
            $password = \Input::post('password');

            // Tìm user theo email
            $user = Model_User::find('first', [
                'where' => [
                    ['email', $email],
                ]
            ]);

            // Kiểm tra password bằng password_verify
            if ($user && password_verify($password, $user->password))
            {
                \Session::set('user_id', $user->id);
                \Response::redirect('admin/dashboard');
            }
            else
            {
                \Session::set_flash('error', 'Sai email hoặc mật khẩu');
            }
        }

        $this->template->title   = 'Đăng nhập';
        $this->template->content = \View::forge('admin/auth/login');
    }

    public function action_logout()
    {
        \Session::delete('user_id');
        \Response::redirect('admin/auth/login');
    }
}
