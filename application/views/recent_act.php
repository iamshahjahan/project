 <div>
 	<?php
 	echo " Recent Activity</br>";
 	foreach($finaldata as $row) {
 		echo "Q. <a href=".site_url().'/question/get/'.$row['q_id'].">".$row['title']."</a>";
 		echo "  Asked on: ".$row['creation_time']."</br>";
 		if(isset($row['answer_time']))
 		{
 			echo "A. <a href=".site_url().'/answer/get/'.$row['a_id'].">".$row['answer_text']."</a>";
 			echo "  answered on: ".$row['answer_time']."</br>";
 		}
 		echo "</br>";
 		echo "</br>";
 		// $qid = $question['q_id'];
 		// $link= site_url('question/get/'.$qid);
 		// echo "<a href='$link'>"."<strong>Title : ".$question['title']."</strong><br></a>";
 		// echo "Description : ".$question['description']."<br>";
 		// echo "Creation time: ".$question['creation_time']."<br> <br>";

 	}

 	// foreach($finaldata as $row) {
 	// 	print_r($row);
 	// 	echo "</br>";
 	// }
 	//echo "</br>";
 	//print_r($finaldata); 
 	?>
 </div>
