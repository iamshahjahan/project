<div class="container-fluid">
	<div class="row">
		<div class="col-sm-offset-4">
			<form id="upload_form" action="<?php echo site_url();?>/register/verifyupload" method="POST" enctype="multipart/form-data">
				<h3>Upload your profile image</h3>
				<br>
				<label class="btn btn-default btn-file">
					<input type="file" id="image" name="image">
				</label>

				<div class="row">
					<div id="upload_error">

					</div>
				</div>
				<br>

				<button class="btn btn-success" type="submit">UPLOAD</button>
				<!-- button for skip option, if user doesn't want to upload a profile pic	 -->
				<div class="btn btn-warning" id="skip_upload">SKIP</div>	
			</form>
		</div>
	</div>
</div>