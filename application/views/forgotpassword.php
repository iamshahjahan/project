<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password</title>
</head>
<body>
	<?php echo validation_errors(); ?>

	<?php echo form_open('forgotpassword'); ?>
		
		<label>Email</label>
		<input type="email" name="email">
		<br>
	
		<button type="submit" name="submit">Send password-reset link to this Email</button>

	</form>
</body>
</html>