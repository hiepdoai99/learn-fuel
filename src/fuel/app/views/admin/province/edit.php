<h2>Sửa Tỉnh/Thành</h2>

<?php echo Form::open(array('action' => 'admin/province/edit/'.$province->id)); ?>
    <div class="form-group">
        <?php echo Form::label('Tên tỉnh/thành', 'name'); ?>
        <?php echo Form::input('name', Input::post('name', isset($province) ? $province->name : ''), array('class' => 'form-control')); ?>
    </div>

    <div class="form-group">
        <?php echo Form::submit('submit', 'Cập nhật', array('class' => 'btn btn-primary')); ?>
        <?php echo Html::anchor('admin/province', 'Hủy', array('class' => 'btn btn-default')); ?>
    </div>
<?php echo Form::close(); ?>
