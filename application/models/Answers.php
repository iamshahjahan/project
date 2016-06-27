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
			$sql = $this->conn_id->prepare("INSERT INTO answers(q_id, user_id, answer_text) VALUES (?,?,?)");
			return $sql->execute($data);
		}
	}
?>