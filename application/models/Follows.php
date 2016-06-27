<?php 
 	/**
 	* 
 	*/
 	class Follows extends MY_Model
 	{
 		
 		function __construct()
 		{
 			parent::__construct('follows','');
 		}

 		function get($tag_id = 0,$user_id = 0)
 		{
 			$sql = $this->conn_id->query("select * from follows where tag_id = '".$tag_id."' and user_id = '".$user_id."' ");
 			if($result = $sql -> fetchAll(PDO::FETCH_ASSOC))
 				return $result;
 			else
 				return 0;
 		}
 	}
 	?>