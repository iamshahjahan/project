	<!-- display question related data -->
	
	<!-- let us display all question tagged to the above tag. Need to add pagination here. -->

	<?php
		// let us check whether an entry related to current user and tag exists in the table or not?
	$tag_id = $result[0]['tag_id'];
	
	?>
	<div class="container">
		<div class="row">
			<div class="col-md-offset-4">
				<form id="follows" method="POST" action="<?php echo site_url();?>/follows">
					<input type="hidden" id="tag_id" value="<?php echo $result[0]['tag_id'];?>" />
					<input type="hidden" id="user_id" value="<?php echo $this->session->userdata('logged_in')['user_id'];?>" />


					<div class="col-md-6">
						





						<h4 class="card-title"><a href="<?php echo site_url(); ?>/tag/get/<?php echo $result[0]['tag_id'] ?>">
							<?php echo $result[0]['name']; ?>
						</a></h4>
					</div>
					<div class="col-md-6">

						<?php 

						if ( $this->Follows->get($result[0]['tag_id'],$this->session->userdata('logged_in')['user_id']) )
						{
							?>
							<p class="card-text"><button id="unfollow" class="btn btn-danger">Un Follow</button></p>

							
							<?php
						}
						else
						{
							?>
							<p class="card-text"><button id="follow" class="btn btn-success">Follow</button></p>
							<?php
						}
						?>
					</div>
				</form>
			<h3 class=""><?php if (isset($count_followers)) echo "Total Followers: ". $count_followers ?></h3>
			</div>
		</div>
	</div>



	<?php

	// Now we need to get all questions from table related 
	$i = 0;
	if ( isset($questions) && $questions != null)
	{
		var_dump($questions);
		foreach ($questions as $question) {
			?>
			<a href="<?php echo site_url().'/question/get/'.$question['q_id'];?>">
				<?php  
				echo $question['title'];
				?>
			</a>

			<?php
		}

	}
	?>
