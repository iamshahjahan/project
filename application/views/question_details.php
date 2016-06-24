<!DOCTYPE html>
<html>
<head>
	<title>Question Details</title>
</head>
<body>
	<!-- this file is to display qeustion details -->

	<!-- display question related data -->
	<h1><?php echo $result[0]['title']; ?></h1>
	<h1><?php echo $result[0]['description']; ?></h1>
	<h1><?php echo $result[0]['creation_time']; ?></h1>
	<h1><?php echo $result[0]['user_id']; ?></h1>

</body>
</html>