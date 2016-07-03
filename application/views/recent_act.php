<div class="container">
	<h1 class="page-header">Recent Activity</h1>
	<div class="row">
		<div >
			<ul id="timeline">
				<?php
				// var_dump($finaldata);
				foreach($finaldata as $row) {
					?>

					<li class="jumbotron" style="display: list-item;">
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

			<!-- add pagination here. -->
			<div class="text-center">
				<ul class="pagination pagination-lg">
					<?php 
						$currrent_page = $offset / 5;
						$next_page = $currrent_page + 1;
						$previous_page = $currrent_page - 1;
						$last_page = ceil($total_results / 5 );

					?>
					<li class="<?php if ($previous_page < 0) echo "disabled"; ?>"><a href="<?php echo site_url(); ?>/profile?page=<?php echo $previous_page; ?>">&laquo;</a></li>
					<li><a href="#"><?php echo $currrent_page + 1; ?></a></li>
					<li class="<?php  if ($next_page >= $last_page) echo "disabled"; ?>">
						<a href="<?php echo site_url(); ?>/profile?page=<?php echo $next_page; ?>"">&raquo;</a>
					</li>
				</ul>
			</div>

		</div>

	</div>
</div>