
<div class="container">
	<h1 class="page-header"><?php echo $result[0]['title']; ?></h1
		>
		<div class="row">
			<?php 
				foreach ($tags as $tag) {
			?>
				<a href="<?php echo site_url();?>/tag/get/<?php echo $tag[0]['tag_id'];?>"><button class="btn btn-success"><?php echo $tag[0]['name'];?></button></a>
			<?php
				}
			 ?>
		</div>

		<div class="content">
			<p><?php echo $result[0]['description']; ?></p>
		</div>
			
		<h5 class="date"><i class="fa fa-clock-o" aria-hidden="true"></i>
			<?php 
			echo $result[0]['creation_time'];
			?>
		</h5>
		<h5 class="date"><i class="fa fa-user" aria-hidden="true"></i>
			<a href="<?php echo site_url(); ?>/profile/get/<?php echo $result[0]['user_id']; ?>">
				<?php 
				echo $this->Users->get($result[0]['user_id'])[0]['name']; 
				?>
			</a>
		</h5>
		<br>
		<br>
		<div class="row">
			<!-- left column -->

			<div class="col-md-8">
				
				<form class="form-horizontal" id="answer_form" method="POST" action="<?php echo site_url(); ?>/answer">
					<!-- answer text-area goes here. -->
					<div class="form-group">
						<label for="answer" class="col-sm-2 control-label">Answer</label>
						<div class="col-sm-8">
							<textarea class="form-control" cols="5" rows="5" id="answer" name="answer" placeholder="Your answer" required autofocus></textarea>
						</div>

					</div>

					<div class="row">
						<div  class="col-sm-offset-2" id="answer_error"></div>
					</div>

					<input type="hidden" id="user_id" name="user_id" value="<?php echo $this->session->userdata("logged_in")['user_id']; ?>">
					<input type="hidden" name="q_id" id="q_id" value="<?php echo $result[0]['q_id']; ?>">


					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-8">
							<button type="submit" name="submit" class="btn btn-success">Submit</button>
						</div>
					</div>
				</form>
			</div>

		</div>
		<?php 
		// var_dump($answers);f
		if ( ($answers))
		{
			foreach ( $answers as $answer )
			{
				?>
				<div class="row">
					<div class="col-md-8">
						<div class="well">
							<h4><?php echo $answer['answer_text']; ?></h4>
							<h5 class="date"><i class="fa fa-clock-o" aria-hidden="true"></i>
								<?php 
								echo $answer['answer_time'];
								?>
							</h5>
							<h5 class="date"><i class="fa fa-user" aria-hidden="true"></i>
								<a href="<?php echo site_url(); ?>/profile/get/<?php echo $answer['user_id']; ?>">
									<?php 
									echo $this->Users->get($answer['user_id'])[0]['name']; 
									?>
								</a>
							</h5>
						</div>
					</div>
				</div>



				<?php
			}
		}
		?>
	</div>

	<?php 
		$this->load->view('pagination_view');
	 ?>

	