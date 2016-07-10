<div class="container">
	<h1 class="page-header">Recent Activity</h1>
	<div class="row">
		<div >
			<ul id="timeline">
				<?php
				// var_dump($finaldata);
				foreach($finaldata as $row) {

					$followed_tag_list = $this->Follows->get(0,$this->session->userdata('logged_in')['user_id']);

					$followed_tag_array = array();
					if ( $followed_tag_array )
					{
						
						foreach ($followed_tag_list as $followed_tag) {
							array_push($followed_tag_array, $followed_tag['tag_id']);
						}
					}

					// var_dump($followed_tag_array);

					$tag_ids = $this->Question_tags->get_tag_id($row['q_id']);

					$tags = array();
				// var_dump($tag_ids);

					if ( $tag_ids)
					{
						foreach ($tag_ids as $tag_id) {
					// var_dump($tag_id);
							array_push($tags, $this->Tags->get($tag_id[0]));
						}
					}

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
							<div class="tags">

								<?php 
								foreach ($tags as $tag) {
									?>
									<a href="<?php echo site_url();?>/tag/get/<?php echo $tag[0]['tag_id'];?>"><button class="btn btn-primary"><?php echo $tag[0]['name'];?></button></a>
									<?php
								}
								?>
							</div>
							<br>

							<span class="name">
								Asked by:

								<?php 

								if ( $row['q_u_id'] != $this->session->userdata('logged_in')['user_id'])
									echo "<a href=".site_url().'/profile/get/'.$row['q_u_id'].">".$row['qauthor']."</a></br>";
								else
								{
									echo "You";
								}
								?>
							</span>
							<span class="separator">•</span>
							<span class="date"><i class="fa fa-clock-o" aria-hidden="true"></i>
								<?php 
								echo $row['creation_time'];
								?>
							</span>
							<hr/>
							<div class="well">
								<div class="header">
									<?php
									echo $row['answer_text'];
									?>
								</div>


								<span class="name">
									Answered by:

									<?php 

									if ( $row['user_id'] != $this->session->userdata('logged_in')['user_id'])
										echo "<a href=".site_url().'/profile/get/'.$row['user_id'].">".$row['aauthor']."</a></br>";
									else
									{
										echo "You";
									}
									?>
								</span>
								<span class="separator">•</span>
								<span class="date"><i class="fa fa-clock-o" aria-hidden="true"></i>
									<?php 
									echo $row['answer_time'];
									?>
								</span>
							</div>

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

							<div class="tags">

								<?php 
								foreach ($tags as $tag) {
									?>
									<a href="<?php echo site_url();?>/tag/get/<?php echo $tag[0]['tag_id'];?>"><button class="btn btn-primary"><?php echo $tag[0]['name'];?></button></a>
									<?php
								}
								?>
							</div>
							<br>

							<span class="name">
								Asked by:

								<?php 

								if ( $row['user_id'] != $this->session->userdata('logged_in')['user_id'])
									echo "<a href=".site_url().'/profile/get/'.$row['user_id'].">".$row['aauthor']."</a></br>";
								else
								{
									echo "You";
								}
								?>
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