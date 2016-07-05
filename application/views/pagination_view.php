<!-- add pagination here. -->
<div class="text-center">
	<ul class="pagination pagination-lg">
		<?php 
		$currrent_page = $offset / 5;
		$next_page = $currrent_page + 1;
		$previous_page = $currrent_page - 1;
		$last_page = ceil($total_results / 5 );

		// echo "total_results". $total_results;
		// echo "total_results". $last_page;
		

		if ( $previous_page < 0 )
		{
			?>
			<li class="<?php echo "disabled"; ?>">
			</li>

				<?php
			}
			else
			{
				?>
				<li>
					<a href="<?php echo site_url(); ?>/<?php echo $page_name; ?>?page=<?php echo $previous_page; ?>">&laquo;</a></li>

					<?php
				}

				?>

				<li><a href="#"><?php echo $currrent_page + 1; ?></a></li>
				<?php
				if ( $next_page >= $last_page )
				{
					?>
					<li class="<?php echo "disabled"; ?>">
							</li>

						<?php
					}
					else
					{
						?>
						<li>
							<a href="<?php echo site_url(); ?>/<?php echo $page_name; ?>?page=<?php echo $next_page; ?>"">&raquo;</a>
						</li>

						<?php
					}

					?>



				</ul>
			</div>