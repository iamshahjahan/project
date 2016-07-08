<?php 

	/**
	* This is the class which returns connection objects to the various models
	*/
	class Connections extends CI_Model
	{
		public function __construct() 
		{
			parent::__construct(); 
			$this->load->database();
		}

		public function get_database_object()
		{
			return $this->load->database('pdo', true)->conn_id;			
		}	
	}
?>