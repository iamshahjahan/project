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

	<form method="POST" action="<?php echo site_url(); ?>/answer/post_answer" id="post_answer">
		<textarea name="textarea" id="answer" rows="10" cols="50"> Post Answer</textarea>
		<!-- get session user id -->
		<input type="hidden" id="user_id" name="user_id" value="1">
		<input type="hidden" name="q_id" id="q_id" value="<?php echo $result[0]['q_id']; ?>">

		<br>
		<button type="submit" id="answer_submit"> Submit </button>


	</form>
	<!-- let us display all answers to the above question. Need to add pagination here. -->
	<?php 
		var_dump($answers);
	 ?>
	


	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/add_answer.js"></script>
</body>
</html>