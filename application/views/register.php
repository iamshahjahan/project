<!DOCTYPE html>
<html>
<head>
	<title>Project</title>
</head>
<body>
	<?php echo validation_errors(); ?>

	<?php echo form_open('register'); ?>
	<!-- <form method="POST" action="register"> -->
		<label>Name</label>
		<input type="text" name="name">
		<br>
		
		<label>Email</label>
		<input type="email" name="email">
		<br>
		
		<label>Mobile No.</label>
		<input type="text" name="mobileno">
		<br>

		<label>Password</label>
		<input type="password" name="password">
		<br>

		<label>Confirm Password</label>
		<input type="password" name="confirm_password">
		<br>

		<button type="submit" name="submit">Register</button>

	</form>
</body>
</html>