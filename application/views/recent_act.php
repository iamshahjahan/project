 <div>
 	<?php
 	echo " Recent Activity</br>";
 	foreach($finaldata as $row) {
 		echo "Q. <a href=".site_url().'/question/get/'.$row['q_id'].">".$row['title']." (".$row['ans_count'].")</a>";
 		echo "  Asked on: ".$row['creation_time']." by <a href=".site_url().'/profile/get/'.$row['user_id'].">".$row['qauthor']."</a></br>";
 		if(isset($row['answer_time']))
 		{
 			echo "A. <a href=".site_url().'/answer/get/'.$row['a_id'].">".$row['answer_text']."</a>";
 			echo "  answered on: ".$row['answer_time']." by <a href=".site_url().'/profile/get/'.$row['q_u_id'].">".$row['aauthor']."</a></br>";
 		}
 		echo "</br>";
 		echo "</br>";
 	}
 	?>
 </div>
