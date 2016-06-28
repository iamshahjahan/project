<?php 
	/**
	* 
	*/
	class Answers extends MY_Model
	{
		
		function __construct()
		{
			parent::__construct('answers','a_id');
		}

		function get_by_question_id($q_id)
		{
			$sql = $this->conn_id->query("select * from answers where q_id = '".$q_id."'");
			if($result = $sql -> fetchAll(PDO::FETCH_ASSOC))
				return $result;
			else
				return 0;
		}
		
		/*
		* args - array of a_id, specify array() of ids else 0 (non array)
		*                       specify limit if order by time and limit results,
		*                       specify u_id if needed for that user
		*/
		// function get_by_aid($a_id=0,$limit=0,$u_id=0)
		// {
		// 	$sql_query = "select * from answers ";
		// 	if(is_array($a_id) || $u_id!=0)
		// 	{
		// 		$sql_query = $sql_query ." where ";
		// 	}

		// 	if($u_id!=0)
		// 	{
		// 		$sql_query = $sql_query."user_id = ".$u_id." ";
		// 	}

		// 	if(is_array($a_id) && $u_id!=0)
		// 	{
		// 		$sql_query = $sql_query ." and ";
		// 	}
		// 	if(is_array($a_id))
		// 	{	
		// 		$sql_query = $sql_query." a_id in (";

		// 		$x = 0;
		// 		for (; $x < count($a_id) - 1; $x++) {
		// 			$sql_query = $sql_query."'".$a_id[$x]."',";
		// 		}
		// 		$sql_query = $sql_query."'".$a_id[$x]."')";	
				
		// 	}

		// 	if($limit!=0)
		// 	{
		// 		$sql_query = $sql_query." order by answer_time desc "." limit ".$limit;
		// 	}
			
		// 	echo $sql_query;
		// 	$sql = $this->conn_id->query($sql_query);
		// 	if($result = $sql -> fetchAll(PDO::FETCH_ASSOC))
		// 		return $result;
		// 	else
		// 		return 0;
		// }

		function insert($data)
		{
			$sql = $this->conn_id->prepare("INSERT INTO answers(q_id, user_id, answer_text) VALUES (?,?,?)");
			return $sql->execute($data);
		}
	}
	?>