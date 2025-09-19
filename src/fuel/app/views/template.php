<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<?php echo Asset::css('bootstrap.css'); ?>
	<style>
		body { margin-top: 60px; }
	</style>
</head>
<body>
	<div class="container">
		<?php if (Session::get_flash('success')): ?>
			<div class="alert alert-success mt-3">
				<strong>Success</strong>
				<p><?php echo implode('</p><p>', e((array) Session::get_flash('success'))); ?></p>
			</div>
		<?php endif; ?>

		<?php if (Session::get_flash('error')): ?>
			<div class="alert alert-danger mt-3">
				<strong>Error</strong>
				<p><?php echo implode('</p><p>', e((array) Session::get_flash('error'))); ?></p>
			</div>
		<?php endif; ?>

		<?php echo $content; ?>

		
	</div>
</body>
</html>
