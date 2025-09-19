<h2>User Detail</h2>

<table class="table table-bordered">
	<tr><th>ID</th><td><?php echo $user->id; ?></td></tr>
	<tr><th>Name</th><td><?php echo e($user->name); ?></td></tr>
	<tr><th>Email</th><td><?php echo e($user->email); ?></td></tr>
</table>

<a href="<?php echo Uri::create('user/edit/'.$user->id); ?>" class="btn btn-warning">Edit</a>
<a href="<?php echo Uri::create('user/delete/'.$user->id); ?>" class="btn btn-danger" onclick="return confirm('Delete user?')">Delete</a>
<a href="<?php echo Uri::create('user'); ?>" class="btn btn-secondary">Back</a>
