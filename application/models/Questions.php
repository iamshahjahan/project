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