<!-- 
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="well well-sm">
				<div class="row">
					<div class="col-sm-6 col-md-4">
						<img src="<?php echo base_url();?>/assets/images/52la_gAU.jpg" alt="" class="img-rounded img-responsive" />
					</div>
					<div class="col-sm-6 col-md-8">
						<h4>
							<?php echo $name; ?></h4>

							<p>
								<i class="glyphicon glyphicon-envelope"></i><?php echo $email; ?>
								<br />

								<i class="glyphicon glyphicon-gift"></i><?php echo $creation_time; ?></p>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	-->

	<div>
		<center>
			<img src="<?php echo base_url();?>/assets/images/<?php echo $profilepic; ?>" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
			<h3 class="media-heading"><?php echo $name; ?> </h3>
			<p>
				<i class="glyphicon glyphicon-envelope"></i> <?php echo $email; ?>
				<br />

				<i class="fa fa-clock-o"></i> <?php echo $creation_time; ?>
			</p>

		</center>
		<hr>
		<center>
			<p class="text-center"><strong>Bio: </strong><br>
			<?php echo $about; ?></p>
				<br>
		</center>
		</div>
