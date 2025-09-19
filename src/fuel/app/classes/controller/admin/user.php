<?php

class Controller_Admin_User extends Controller_Admin_Base
{
    public function action_index()
    {
        $data['users'] = Model_User::find('all');
        $this->template->title = "Users";
        $this->template->content = View::forge('admin/user/index', $data);
    }

    public function action_view($id = null)
    {
        $data['user'] = Model_User::find($id);

        $this->template->title = "User";
        $this->template->content = View::forge('admin/user/view', $data);
    }

    public function action_create()
    {
        if (Input::method() == 'POST')
        {
            $user = Model_User::forge(array(
                'name'     => Input::post('name'),
                'email'    => Input::post('email'),
                'username' => Input::post('email'),
                'password' => password_hash(Input::post('password'), PASSWORD_BCRYPT),
            ));

            if ($user and $user->save())
            {
                Session::set_flash('success', 'Added user #'.$user->id.'.');
                Response::redirect('admin/user');
            }
            else
            {
                Session::set_flash('error', 'Could not save user.');
            }
        }

        $this->template->title = "Create User";
        $this->template->content = View::forge('admin/user/create');
    }

    public function action_edit($id = null)
    {
        $user = Model_User::find($id);

        if (Input::method() == 'POST')
        {
            $user->name     = Input::post('name');
            $user->email    = Input::post('email');
            if (Input::post('password'))
                $user->password = password_hash(Input::post('password'), PASSWORD_BCRYPT);

            if ($user->save())
            {
                Session::set_flash('success', 'Updated user #'.$id);
                Response::redirect('admin/user');
            }
            else
            {
                Session::set_flash('error', 'Could not update user #'.$id);
            }
        }

        $this->template->title = "Edit User";
        $this->template->content = View::forge('admin/user/edit', array('user' => $user));
    }

    public function action_delete($id = null)
    {
        if ($user = Model_User::find($id))
        {
            $user->delete();
            Session::set_flash('success', 'Deleted user #'.$id);
        }
        else
        {
            Session::set_flash('error', 'Could not delete user #'.$id);
        }

        Response::redirect('admin/user');
    }
}
