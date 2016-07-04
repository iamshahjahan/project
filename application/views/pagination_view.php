<!-- add pagination here. -->
<div class="text-center">
	<ul class="pagination pagination-lg">
		<?php 
		$currrent_page = $offset / 5;
		$next_page = $currrent_page + 1;
		$previous_page = $currrent_page - 1;
		$last_page = ceil($total_results / 5 );

		?>
		<li class="<?php if ($previous_page < 0) echo "disabled"; ?>">
			<a href="<?php
				 if ($previous_page >= 0) echo site_url(); ?>/<?php echo $page_name; ?>?page=<?php echo $previous_page; ?>">&laquo;
			</a>
		</li>
		<li><a href="#"><?php echo $currrent_page + 1; ?></a></li>
		<li class="<?php  if ($next_page >= $last_page) echo "disabled"; ?>">
		<a href="<?php echo site_url(); ?>/<?php echo $page_name; ?>?page=<?php echo $next_page; ?>"">&raquo;</a>
		</li>
	</ul>
</div>