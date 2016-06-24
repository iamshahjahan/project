<?php 
	/**
	* 
	*/
	class Question_tags extends MY_Model
	{
		
		function __construct()
		{	
			parent::__construct('tags');
		}

		function insert($q_id, $tag_id)
		{
			try
			{
				// $tags - array of tag ids
				$sql = $this->conn_id->prepare("INSERT INTO question_tags(tag_id, q_id) VALUES (?, ?)");
				$sql->execute(array($tag_id, $q_id));
				return 1;
			}
			catch (PDOException $e)
			{
				// Todo
			}
		}
	}
	?>