
   <h1>My Profile</h1>
   <img src="<?php echo base_url();?>/assets/images/<?php echo $profilepic;?>" alt="Image not available" style="width:200px;height:250px;">
   <a href="register/upload">Upload New Image</a>
   <?php echo validation_errors(); ?>
	<?php echo form_open('profile/edit'); ?>
	<!-- <form method="POST" action="register"> -->
		<label>Name</label>
		<input type="text" name="name" value="<?php echo $name; ?>" >
		<br>
		
		<label>Email</label>
		<label> "<?php echo $email; ?>"</label>
		<br>
		
		<label>Mobile No.</label>
		<input type="text" name="mobileno" value="<?php echo $mobileno; ?>">
		<br>

		<label>About Me</label>
		<input type="txt_area" name="about" rows="5" cols="15" style='width:50%' value="<?php echo $about; ?>">
		<br>

		<label>Activated</label>
		<label> "  <?php echo $is_active?"YES":"NO"; ?>"</label>
		<br>


		<button type="submit" name="submit">Save</button>

	</form>
	<p> JOINED ON : <?php echo $creation_time; ?></p>
 
