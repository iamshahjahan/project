
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
