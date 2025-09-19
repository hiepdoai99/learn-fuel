<?php

class Controller_Admin_Base extends Controller_Template
{
    public $template = 'admin/template';

    public function before()
    {
        parent::before();

        // Check session login
        if (!\Session::get('user_id')) {
            // Nếu chưa login thì redirect về trang login
            \Response::redirect('admin/auth/login');
        }

    }
}
