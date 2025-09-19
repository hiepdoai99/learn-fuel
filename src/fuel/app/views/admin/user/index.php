<div class="d-flex justify-content-between align-items-center mb-4">
	<h2>User List</h2>
	<a style="margin-bottom:16px" href="<?php echo Uri::create('admin/user/create'); ?>" class="btn btn-primary">+ Add User</a>
</div>

<table class="table table-striped table-bordered">
	<thead class="table-dark">
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Email</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($users as $user): ?>
		<tr>
			<td><?php echo $user->id; ?></td>
			<td><?php echo e($user->name); ?></td>
			<td><?php echo e($user->email); ?></td>
			<td>
				<a href="<?php echo Uri::create('admin/user/'.$user->id); ?>" class="btn btn-sm btn-info">View</a>
				<a href="<?php echo Uri::create('admin/user/edit/'.$user->id); ?>" class="btn btn-sm btn-warning">Edit</a>
				<a href="<?php echo Uri::create('admin/user/delete/'.$user->id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete user?')">Delete</a>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
