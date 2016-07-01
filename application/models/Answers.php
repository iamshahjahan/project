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
		
		function insert($data)
		{
			echo "I am in insert.";
			$query = "INSERT INTO answers(q_id, user_id, answer_text) VALUES (?,?,?)" ;
			echo $query ;
			var_dump($data);
			$sql = $this->conn_id->prepare($query);
			return $sql->execute($data);
		}

		function count_by_qid($q_ids){
			if(is_array($q_ids))
			{
				$sql_query = "select q_id,count(*) as count from answers where q_id in (";
				$x = 0;
				for (; $x < count($q_ids) - 1; $x++) {
					$sql_query = $sql_query."'".$q_ids[$x]."',";
				}
				$sql_query = $sql_query."'".$q_ids[$x]."') group by q_id";	
				//echo $sql_query ;
				$sql = $this->conn_id->prepare($sql_query);
				if($sql->execute())
				{
					return  $sql->fetchALL(PDO::FETCH_ASSOC);
				}
				else
				{
					return 0;
				}				
			}
		}
	}
	?>