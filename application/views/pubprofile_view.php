   <h1>Public Profile</h1>
   <img src="<?php echo base_url();?>/assets/images/<?php echo $profilepic;?>" alt="Image not available" style="width:200px;height:250px;">
   <!--?php echo form_open('profile/edit'); ?-->
	<!-- <form method="POST" action="register"> -->
		<br>
		<label>Name: </label>
		<label><?php echo $name; ?> </label>
		<br>
		
		<label>Email: </label>
		<label><?php echo $email; ?> </label>
		<br>
		
		<label>About Me: </label>
		<label><?php echo $about; ?> </label>
		<br>

		
	<p> JOINED ON : <?php echo $creation_time; ?></p>
  