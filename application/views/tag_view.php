<div>
  <h2>Tags</h2>
  <?php
 //print_r($tags);
  foreach($tags as $tag) {
   $tag_id = $tag['tag_id'];
   $link= site_url('tag/get/'.$tag_id);
   echo "<a href='$link'>"."<strong>".$tag['name']."</strong></a>";
} 
echo "</br></br></br></br></br>";
?> 
</div>