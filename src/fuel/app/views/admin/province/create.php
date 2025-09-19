<h2>Thêm mới Tỉnh/Thành</h2>

<?php echo Form::open(); ?>
    <div class="form-group">
        <?php echo Form::label('Tên tỉnh/thành', 'name'); ?>
        <?php echo Form::input('name', Input::post('name', isset($province) ? $province->name : ''), array('class' => 'form-control')); ?>
    </div>

    <div class="form-group">
        <?php echo Form::submit('submit', 'Lưu', array('class' => 'btn btn-primary')); ?>
        <?php echo Html::anchor('admin/province', 'Hủy', array('class' => 'btn btn-default')); ?>
    </div>
<?php echo Form::close(); ?>
