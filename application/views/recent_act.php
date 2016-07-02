


<div class="container">
	<h1 class="page-header">Recent Activity</h1>
	<div class="row">
		<div>
			
		</div>

	</div>
</div>

<ul id="timeline">

	

		<?php
		foreach($finaldata as $row) {
			?>

			<li class="task" style="display: list-item;">
				<?php 
				if(isset($row['answer_time']))
				{
					?>
					<i class="fa fa-comments green"></i>
					

					<div class="header">
						<?php
						echo "Q. <a href=".site_url().'/question/get/'.$row['q_id'].">".$row['title']." (".$row['ans_count'].")</a>";
						?>
					</div>
					 

					<span class="name">
						<?php echo $row['qauthor'];?>
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
						<?php echo "<a href=".site_url().'/profile/get/'.$row['user_id'].">".$row['q_u_id']."</a></br>";?>
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

					<i class="fa fa-question green"></i>
					

					<div class="header">
						<?php
						echo "Q. <a href=".site_url().'/question/get/'.$row['q_id'].">".$row['title']." (".$row['ans_count'].")</a>";
						?>
					</div>
					 

					<span class="name">
						<?php echo $row['qauthor'];?>
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

			
			

			// echo "</br>";
			// echo "</br>";
		}
		?>





<!-- 
		<li class="comment" style="display: list-item;">
			<i class="fa fa-comments red"></i>
			<div class="title">New Bootstrap Theme</div>
			<div class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </div>
			<span class="date"><i class="fa fa-clock-o" aria-hidden="true"></i>Today</span>
			<span class="separator">•</span>
			<span class="name">Ashley Tan</span>
		</li> -->
	</ul>