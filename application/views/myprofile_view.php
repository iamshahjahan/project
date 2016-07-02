
<div class="container">
	<h1 class="page-header">Profile</h1>
	<div class="row">
		<!-- left column -->
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="text-center">
				<img class="img img-circle img-responsive" src="<?php echo base_url();?>/assets/images/<?php echo $profilepic;?>" alt="avatar">
			</div>
			<!-- load upload image view, with an option that it is included in profile image file. -->
			<?php $this->load->view('upload_image',array('is_profile' => true)); ?>
		</div>
		<!-- edit form column -->
		<div class="col-md-8 col-sm-6 col-xs-12 personal-info">

			<br>
			<form class="form-horizontal" id="myprofile_form" method="POST" action="verifyprofile" role="form">
				<div class="form-group">
					<label class="col-lg-3 control-label">Name:</label>
					<div class="col-lg-8">
						<input class="form-control" id="name" name="name" value="<?php echo $name; ?>" type="text">
					</div>
				</div>
				<div class="row">
					<div  class="col-lg-offset-3" id="name_error"></div>
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
						<input class="form-control" id="mobileno" name="mobileno" value="<?php echo $mobileno; ?>" type="text">
					</div>
				</div>
				<div class="row">
					<div  class="col-lg-offset-3" id="mobileno_error"></div>
				</div>

				<div class="form-group">
					<label class="col-lg-3 control-label">About me:</label>
					<div class="col-lg-8">
						<input class="form-control" id="about" name="about" value="<?php echo $about; ?>" type="text">
					</div>
				</div>

				<div class="row">
					<div  class="col-lg-offset-3" id="about_error"></div>
				</div>

				<div class="form-group">
					<label class="col-lg-3 control-label">Join date:</label>
					<div class="col-lg-8">
						<input class="form-control" value="<?php echo $creation_time; ?>" type="text" disabled>
					</div>
				</div>

				<div class="row">
					<div  class="col-lg-offset-3" id="myprofile_form_error"></div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label"></label>
					<div class="col-md-8">
						<input class="btn btn-primary" value="Save Changes" type="submit" name="submit">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
