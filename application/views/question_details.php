<div class="container">
	<h1 class="page-header"><?php echo $result[0]['title']; ?></h1
		>
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

		<div class="row">
			<!-- left column -->
			<div class="content">
				<h4><?php echo $result[0]['description']; ?></h4>
			</div>

			<div class="panel panel-success">
				<div class="panel panel-heading">
					Add an answer
				</div>

				<div class="panel panel-body">
				<form class="form-horizontal" id="answer_form" method="POST" action="<?php echo site_url(); ?>/answer">
						<!-- answer text-area goes here. -->
						<div class="form-group">
							<label for="answer" class="col-sm-2 control-label">Answer</label>
							<div class="col-sm-8">
								<textarea class="form-control" id="answer" name="answer" placeholder="Your answer" required autofocus></textarea>
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
					<!-- register and forgot password button. -->
				</div>
			</div>
		</div>
	</div>


	<!-- this file is to display qeustion details -->

	<!-- display question related data -->




	
	<!-- let us display all answers to the above question. Need to add pagination here. -->
	<?php 
		var_dump($answers);		
	 ?>


	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/add_answer.js"></script>
</body>
</html>