<div class="container">
	<div class="row">
		<div>
			<div>
				<!-- Nav tabs -->
				<ul class="nav nav-tabs nav-justified" role="tablist">
					<li role="presentation" class="active"><a href="#recent_activities" aria-controls="recent_activities" role="tab" data-toggle="tab">Recent Activities</a></li>
					<li role="presentation"><a href="#my_interests" aria-controls="my_interests" role="tab" data-toggle="tab">My Interests</a></li>

				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="recent_activities">
						<?php 		 
						$this->recent_activity->recent_act(0,5,$offset);

						$this->load->view('pagination_view',
							array(
								'total_results' => $total_results,
								'offset' => $offset,
								'page_name' => $page_name)
							);

							?>
						</div>
						<div role="tabpanel" class="tab-pane" id="my_interests">

							<?php 		 
							$this->recent_activity->recent_act(0,5,$offset,$is_interest = true);

							$this->load->view('pagination_view',
								array(
									'total_results' => $total_results,
									'offset' => $offset,
									'page_name' => $page_name,
									
									)
								);

								?>


							</div>
						</div>

					</div>
				</div>
			</div>
		</div>