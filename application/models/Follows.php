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

 		function get_followers($tag_id)
 		{
 			$sql = "SELECT * FROM follows WHERE tag_id = ".$tag_id; 
 			$result = $this->conn_id->prepare($sql); 
 			$result->execute(); 
 			  
 			return count($result->fetchAll()); 
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
 		function count($tag_id)//tag page
 		{
 			try {
 				$sql = $this->conn_id->query("SELECT count(user_id) FROM follows where tag_id=".$tag_id." group by tag_id");
 				$row = $sql->fetchALL(PDO::FETCH_ASSOC);
 				if(count($row) > 0)
 					return $row[0]['count(user_id)'];
 				else
 					return 0;

 			} catch (PDOException $e) {

 			}
 		}
 		function get_tags($user_id)
 		{
 			$query = "SELECT f.user_id, f.tag_id, t.name FROM follows as f ";
 			$query .= "inner join tags AS t ON f.tag_id = t.tag_id where f.user_id = ".$user_id;
 			$sql = $this->conn_id->prepare($query);
 			$sql->execute();
 			$r = $sql->fetchALL(PDO::FETCH_ASSOC);
 			return $r;
 		}
 	}
 	?>