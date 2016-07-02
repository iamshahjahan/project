<!-- <div>
	<h2>Tags</h2>

	echo "</br></br></br></br></br>";
	?> 
</div>
-->

<div class="container">
	<h1 class="page-header">Tags Followed</h1>
	<div class="row">
		<div class="col-md-4 col-sm-6 col-xs-12">
			<table class = "table table-bordered">

				<tbody>

					<?php
 //print_r($tags);

					foreach($tags as $tag) {
						$tag_id = $tag['tag_id'];
				// $link= site_url('tag/get/'.$tag_id);
				// echo "<a href='$link'>"."<strong>".$tag['name']."</strong></a><br>";

				// $result[0]['tag_id'];
						$result[0] = $tag;
						$this->load->view('tag_details',array('result' => $result));

					} 	
					?>
				</tbody>

			</table>
		</div>
	</div>
</div>

