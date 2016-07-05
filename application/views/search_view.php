<body>
	<h2>Search Results</h2>
	<!--label for="count"><?php echo $count;?>  results found</label-->
	<?php
	echo '</br>';
	// foreach ($docs as $res) {
	// 	echo "<a href=".site_url()."/tags/get/".$res['id'].'>'.$res['name'].'</a> </br>';	
	// }
	foreach ($tags as $res) {
		echo $res.' </br>';	
	}
	?>
</body>
