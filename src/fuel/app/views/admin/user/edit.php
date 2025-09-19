<h2>Edit User #<?php echo $user->id; ?></h2>

<form method="post" class="mt-3">
	<div class="mb-3">
		<label class="form-label">Name</label>
		<input type="text" name="name" class="form-control" value="<?php echo e($user->name); ?>" required>
	</div>
	<div class="mb-3">
		<label class="form-label">Email</label>
		<input type="email" name="email" class="form-control" value="<?php echo e($user->email); ?>" required>
	</div>
	<div class="mb-3">
		<label class="form-label">Password (leave blank if unchanged)</label>
		<input type="password" name="password" class="form-control">
	</div>
	<button type="submit" class="btn btn-primary">Update</button>
	<a href="<?php echo Uri::create('user'); ?>" class="btn btn-secondary">Cancel</a>
</form>
