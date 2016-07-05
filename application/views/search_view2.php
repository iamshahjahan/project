<body>
	<h2>Search Results</h2>
	<label for="count"><?php echo $count;?>  results found</label>
	<?php
	echo '</br>';
	foreach ($docs as $res) {
		echo "<a href=".site_url()."/question/get/".$res['id'].'>'.$res['q_title'].'</a> </br>';	
	}
	?>
</body>
