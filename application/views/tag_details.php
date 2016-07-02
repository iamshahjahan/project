	<!-- display question related data -->
	
	<!-- let us display all question tagged to the above tag. Need to add pagination here. -->

	<?php
		// let us check whether an entry related to current user and tag exists in the table or not?
	$tag_id = $result[0]['tag_id'];
	
	?>
	<form id="follows" method="POST" action="<?php echo site_url();?>/follows">
		<input type="hidden" id="tag_id" value="<?php echo $result[0]['tag_id'];?>" />
		<input type="hidden" id="user_id" value="<?php echo $this->session->userdata('logged_in')['user_id'];?>" />


		
				<tr>
					<td><h4><?php echo $result[0]['name']; ?></h4></td> 
					



					<!-- // enter the name of the button -->


					<?php 

					if ( $this->Follows->get($result[0]['tag_id'],$this->session->userdata('logged_in')['user_id']) )
					{
						?>

						<td><button id="unfollow" class="btn btn-danger">Un Follow</button></td>
						<?php
					}
					else
					{
						?>
						<td><button id="follow" class="btn btn-success">Follow</button></td>


						<?php
					}
					?>
				</tr>


			

	</form>

	<?php
	
	// Now we need to get all questions from table related 
	// var_dump($questions);
	// echo site_url().'/question/get/';
	$i = 0;
	if ( isset($questions) && $questions != null)
	{
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
	