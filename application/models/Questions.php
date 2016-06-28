<?php 
	/**
	* 
	*/
	class Questions extends MY_Model
	{
		
		function __construct()
		{	
			parent::__construct('questions','q_id');
		}

		/*
		* args - array of q_id, specify array() of ids else 0 non array
		*                       specify limit if order by time and limit results,
		*                       specify u_id if needed for that user
		*/
		// function get_by_qid($q_id=0,$limit=0,$u_id=0)
		// {
		// 	$sql_query = "select * from questions ";
		// 	if(!($q_id==0 && $u_id==0))
		// 	{
		// 		$sql_query = $sql_query ." where ";
		// 	}

		// 	if($u_id!=0)
		// 	{
		// 		$sql_query = $sql_query."user_id = ".$u_id." ";
		// 	}

		// 	if($q_id!=0 && $u_id!=0)
		// 	{
		// 		$sql_query = $sql_query ." and ";
		// 	}
			
		// 	if($q_id!=0)
		// 	{
		// 		$sql_query = $sql_query." q_id in (";

		// 		$x = 0;
		// 		for (; $x < count($q_id) - 1; $x++) {
		// 			$sql_query = $sql_query."'".$q_id[$x]."',";
		// 		}
		// 		$sql_query = $sql_query."'".$q_id[$x]."')";	
				
		// 	}

		// 	if($limit!=0)
		// 	{
		// 		$sql_query = $sql_query." order by creation_time desc "." limit ".$limit;
		// 	}
			
		// 	//echo $sql_query;
		// 	$sql = $this->conn_id->query($sql_query);
		// 	if($result = $sql -> fetchAll(PDO::FETCH_ASSOC))
		// 		return $result;
		// 	else
		// 		return 0;
		// }

		/*
		* args - array of q_id, specify limit if order by time and limit results,
		*                       specify u_id if needed for that user
		*/
		// function get_by_qi($q_id,$limit=0,$u_id=0)//to be removed
		// {
		// 	$sql_query = "select * from questions where ";
		// 	if($u_id!=0)
		// 	{
		// 		$sql_query = $sql_query."user_id = ".$u_id." and ";
		// 	}
		// 	$sql_query = $sql_query." q_id in (";
		// 	$x = 0;
		// 	for (; $x < count($q_id) - 1; $x++) {
		// 		$sql_query = $sql_query."'".$q_id[$x]."',";
		// 	}
		// 	if(count($q_id)>=1)
		// 	{
		// 		$sql_query = $sql_query."'".$q_id[$x]."'";	
		// 	}
		// 	$sql_query=$sql_query.")";

		// 	if($limit!=0)
		// 	{
		// 		$sql_query = $sql_query." order by creation_time desc "." limit ".$limit;
		// 	}
			
		// 	//echo $sql_query;
		// 	$sql = $this->conn_id->query($sql_query);
		// 	if($result = $sql -> fetchAll(PDO::FETCH_ASSOC))
		// 		return $result;
		// 	else
		// 		return 0;
		// }

		function insert($data)
		{
			try
			{
				$sql = $this->conn_id->prepare("INSERT INTO questions(title, description, user_id) VALUES (?,?,?)");
				$sql->execute($data);
				$affected_rows = $sql->rowCount();
				return array($affected_rows, $this->conn_id->lastInsertId());
			}
			catch (PDOException $e)
			{
				// Todo
			}
		}


	}
	?>