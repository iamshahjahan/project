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

			if ( $this->Follows->get($result[0]['tag_id'],$this->session->userdata('logged_in')['user_id']) )
			{
				echo "Use has followed.";
				// show follow button here

				?>

				<button id="unfollow">UnFollow</button>

				<?php

			}
			else
			{
				?>

				<button id="follow">Follow</button>

				<?php

				echo "user have not followed.";
			}
		}


	?>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/follow.js"></script>
</body>
</html>