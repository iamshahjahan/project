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

 		function insert($data)
 		{
 			// if ( isset($_POST['tag_id']) && isset($_POST['user_id']))
 			// {
 				// insert into the follows database.

 			$sql = $this->conn_id->prepare("INSERT INTO follows(tag_id,user_id) values(?,?)");

 			return $sql->execute($data);

 			// }
 			// else
 			// {
 			// 	return 0;
 			// }
 		}

 		function delete($data)
 		{
 			$sql = $this->conn_id->prepare("DELETE FROM follows where tag_id = '".$data[0]."' and user_id = '".$data[1]."'");
 			// echo $sql;

 			if ( $sql->execute() )
 			{
 				echo "success";
 			}
 			else
 			{
 				echo "Unsuccess.";
 			}
 		}
 	}
 	?>