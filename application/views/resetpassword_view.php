<div class="container-fluid">
	<div class="row">
		<div class="col-sm-offset-3 col-sm-6">

			<div class="panel panel-success">
				<div class="panel panel-heading">
					Change your password.
				</div>

				<div class="panel panel-body">
					<form class="form-horizontal" id="reset_password_form" method="POST" action="verifyresetpassword">
						<!-- enter your password here. -->
						<div class="form-group">
							<label for="password" class="col-sm-2 control-label">Password</label>
							<div class="col-sm-8">
								<input type="password" class="form-control" id="password" name="password" placeholder="Password" required autofocus>
							</div>

						</div>

						<div class="row">
							<div  class="col-sm-offset-2" id="reset_password_from"></div>
						</div>
						<!-- enter your confirm password -->
						<div class="form-group">
							<label for="confirm_password" class="col-sm-2 control-label">Confirm Password</label>
							<div class="col-sm-8">
								<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
							</div>

						</div>	
						<input type="hidden" name="email" value="<?php echo $email; ?>">

						<div class="row">
							<div  class="col-sm-offset-2" id="confirm_password_error"></div>
						</div>
						<!-- sign in button is here. -->
						<div class="row">
							<div  class="col-sm-offset-2" id="reset_password_form_error"></div>
						</div>
						<br>

						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-8">
								<button type="submit" name="submit" class="btn btn-success">Reset</button>
							</div>
						</div>
					</form>
					
				</div>
			</div>
		</div>
	</div>
