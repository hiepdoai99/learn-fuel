<h2>Create User</h2>

<form method="post" class="mt-3">
	<div class="mb-3">
		<label class="form-label">Name</label>
		<input type="text" name="name" class="form-control" required>
	</div>
	<div class="mb-3">
		<label class="form-label">Email</label>
		<input type="email" name="email" class="form-control" required>
	</div>
	<div class="mb-3">
		<label class="form-label">Password</label>
		<input type="password" name="password" class="form-control" required>
	</div>
	<button type="submit" class="btn btn-success">Save</button>
	<a href="<?php echo Uri::create('user'); ?>" class="btn btn-secondary">Cancel</a>
</form>
