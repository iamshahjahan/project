<?php 
	/**
	* this is a user table
	*/
	class Users extends MY_Model
	{
		
		function __construct()
		{
			parent::__construct('users');
			$this->load->library('Connections');
			// $this->_assign_libraries();
			$this->conn_id = $this->connections->get_database_object();
		}
		// need to update insert function in my_model 
		function insert($data)
		{
			
			$query = $this->conn_id->prepare("INSERT INTO users(name, email, mobileno, profilepic, passwd, hash_key) VALUES (?,?,?,?,?,?)");
			$query->execute($data);
		}
	}
	?>
