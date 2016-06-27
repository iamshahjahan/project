<!DOCTYPE html>
<html>
<head>
	<title>Question Details</title>
</head>
<body>
	<!-- this file is to display qeustion details -->

	<!-- display question related data -->
	<h2><?php echo $result[0]['name']; ?></h2>
	
	<!-- let us display all question tagged to the above tag. Need to add pagination here. -->

	<?php
		// let us check whether an entry related to current user and tag exists in the table or not?
	$tag_id = $result[0]['tag_id'];
	
	if ( $this->session->userdata('logged_in') != null )
	{
			// get data from follows to check whether the data exists or not.

		?>
		<form id="follows" method="POST" action="<?php echo site_url();?>/follows">
			<input type="hidden" id="tag_id" value="<?php echo $result[0]['tag_id'];?>" />
			<input type="hidden" id="user_id" value="<?php echo $this->session->userdata('logged_in')['user_id'];?>" />

			<?php

			if ( $this->Follows->get($result[0]['tag_id'],$this->session->userdata('logged_in')['user_id']) )
			{
				echo "User has followed.";
				// show follow button here

				?>

				<button id="unfollow">UnFollow</button>

				<?php

			}
			else
			{
				?>

				<button id="follow">Follow</button>

			</form>
				<?php

				echo "user have not followed.";
			}
	}
	else
	{
		echo "User is not logged in.";
	}
	// Now we need to get all questions from table related 
	// var_dump($questions);
	// echo site_url().'/question/get/';
	foreach ($questions as $key => $value) {
		?>
			<a href="<?php echo site_url().'/question/get/'.$questions[1]['q_id'];?>">
			<?php  
				echo $value['title'];
			?>
			</a>

		<?php

	}



	?>



	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/follow.js"></script>
</body>
</html>