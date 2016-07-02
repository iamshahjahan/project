
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

	    <!--label>Password</label>
		<input type="password" name="password" value="<?php echo $name; ?>">
		<br>

		<label>Confirm Password</label>
		<input type="password" name="confirm_password">
		<br-->

		<button type="submit" name="submit">Save</button>

	</form>
	<p> JOINED ON : <?php echo $creation_time; ?></p>
 


<div class="container" style="padding-top: 60px;">
	<h1 class="page-header">Profile</h1>
	<div class="row">
		<!-- left column -->
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="text-center">
				<img class="img img-circle img-responsive" src="<?php echo base_url();?>/assets/images/<?php echo $profilepic;?>" alt="avatar">
<!-- 				<input type="file" class="text-center center-block well well-sm">
 -->		
 			</div>
 			<!-- load upload image view, with an option that it is included in profile image file. -->
 			<?php $this->load->view('upload_image',array('is_profile' => true)); ?>
		</div>
		<!-- edit form column -->
		<div class="col-md-8 col-sm-6 col-xs-12 personal-info">
			<!-- <div class="alert alert-info alert-dismissable">
				<a class="panel-close close" data-dismiss="alert">×</a> 
				<i class="fa fa-coffee"></i>
				This is an <strong>.alert</strong>. Use this to show important messages to the user.
			</div> -->
			<br>
			<form class="form-horizontal" role="form">
				<div class="form-group">
					<label class="col-lg-3 control-label">Name:</label>
					<div class="col-lg-8">
						<input class="form-control" value="<?php echo $name; ?>" type="text">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-lg-3 control-label">Email:</label>
					<div class="col-lg-8">
						<input class="form-control" value="<?php echo $email; ?>" type="text" disabled>
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-3 control-label">Mobile:</label>
					<div class="col-lg-8">
						<input class="form-control" value="<?php echo $mobileno; ?>" type="text">
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-3 control-label">About me:</label>
					<div class="col-lg-8">
						<input class="form-control" value="<?php echo $about; ?>" type="text">
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-3 control-label">Join date:</label>
					<div class="col-lg-8">
						<input class="form-control" value="<?php echo $creation_time; ?>" type="text" disabled>
					</div>
				</div>
			
				<div class="form-group">
					<label class="col-md-3 control-label"></label>
					<div class="col-md-8">
						<input class="btn btn-primary" value="Save Changes" type="button">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
