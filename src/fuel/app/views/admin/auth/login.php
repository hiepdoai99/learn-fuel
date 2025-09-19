<div style="display:flex;align-items:center;justify-content:center;height:100vh;">
    <div style="width:350px;">
        <div style="background:#fff;box-shadow:0 4px 15px rgba(0,0,0,0.1);border-radius:12px;overflow:hidden;">
            <div style="padding:30px;">
                <h2 style="text-align:center;margin-bottom:25px;color:#007bff;font-family:sans-serif;">
                    Đăng nhập Admin
                </h2>

                <?php echo Form::open(['style' => 'display:block;']); ?>

                <div style="margin-bottom:20px;">
                    <?php echo Form::label('Email', 'email', [
                        'style' => 'display:block;margin-bottom:8px;font-weight:600;font-family:sans-serif;'
                    ]); ?>
                    <?php echo Form::input('email', Input::post('email', ''), [
                        'style' => 'width:100%;padding:10px 12px;border:1px solid #ccc;border-radius:8px;font-size:14px;font-family:sans-serif;',
                        'placeholder' => 'Nhập email',
                        'required' => true
                    ]); ?>
                </div>

                <div style="margin-bottom:20px;">
                    <?php echo Form::label('Mật khẩu', 'password', [
                        'style' => 'display:block;margin-bottom:8px;font-weight:600;font-family:sans-serif;'
                    ]); ?>
                    <?php echo Form::password('password', '', [
                        'style' => 'width:100%;padding:10px 12px;border:1px solid #ccc;border-radius:8px;font-size:14px;font-family:sans-serif;',
                        'placeholder' => 'Nhập mật khẩu',
                        'required' => true
                    ]); ?>
                </div>

                <div style="text-align:center;">
                    <?php echo Form::submit('submit', 'Đăng nhập', [
                        'style' => 'background:#007bff;color:#fff;border:none;border-radius:8px;padding:12px 20px;font-size:16px;font-weight:600;cursor:pointer;width:100%;transition:0.3s;'
                    ]); ?>
                </div>

                <?php echo Form::close(); ?>
            </div>
        </div>
    </div>
</div>
