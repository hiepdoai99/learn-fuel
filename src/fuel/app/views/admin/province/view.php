<h2>Chi tiết Tỉnh/Thành</h2>

<p>
    <strong>ID:</strong>
    <?php echo $province->id; ?>
</p>
<p>
    <strong>Tên:</strong>
    <?php echo $province->name; ?>
</p>

<?php echo Html::anchor('admin/province/edit/'.$province->id, 'Sửa', array('class' => 'btn btn-primary')); ?> |
<?php echo Html::anchor('admin/province', 'Quay lại danh sách', array('class' => 'btn btn-default')); ?>
