<div class="container">
	<h1 class="page-header">Recent Activity</h1>
	<div class="row">
		<div >
			<ul id="timeline">
				<?php
				// var_dump($finaldata);
				foreach($finaldata as $row) {
					?>

					<li class="well" style="display: list-item;">
						<?php 
						if(isset($row['answer_time']))
						{
							?>
							<i class="fa fa-comments green">Answer</i>


							<div class="header">
								<h4>
									<?php
									echo "Q. <a href=".site_url().'/question/get/'.$row['q_id'].">".$row['title']." (".$row['ans_count'].")</a>";
									?>
								</h4>
							</div>


							<span class="name">
								Asked by: <?php echo "<a href=".site_url().'/profile/get/'.$row['q_u_id'].">".$row['qauthor']."</a></br>";?>
							</span>
							<span class="separator">•</span>
							<span class="date"><i class="fa fa-clock-o" aria-hidden="true"></i>
								<?php 
								echo $row['creation_time'];
								?>
							</span>


							<div class="header">
								<?php
								echo $row['answer_text'];
								?>
							</div>


							<span class="name">
								Answered by you.
							</span>
							<span class="separator">•</span>
							<span class="date"><i class="fa fa-clock-o" aria-hidden="true"></i>
								<?php 
								echo $row['answer_time'];
								?>
							</span>

							<?php
						} 
						else
						{
							?>

							<i class="fa fa-question green">Question</i>


							<div class="header">
								<h4>
									<?php
									echo "Q. <a href=".site_url().'/question/get/'.$row['q_id'].">".$row['title']." (".$row['ans_count'].")</a>";
									?>
								</h4>
							</div>


							<span class="name">
								Asked by you.
							</span>
							<span class="separator">•</span>
							<span class="date"><i class="fa fa-clock-o" aria-hidden="true"></i>
								<?php 
								echo $row['creation_time'];
								?>
							</span>


							<?php
						}
						?>

					</li>
					<?php
				}
				?>

			</ul>

			

		</div>

	</div>
</div>