<!DOCTYPE html>
<html>
<head>
	<title>Upload Image</title>
</head>
<body>
	<form action="<?php	echo site_url();?>/register/upload" method="POST" enctype="multipart/form-data">
		<input type="file" name="image" />
		<input type="submit"/>
	</form>
</body>
</html>