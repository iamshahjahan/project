<?php 
	/**
	* The base table model where each and every table will get data from
	*/
	class MY_Model extends CI_Model
	{
		private $table_name;
		private $conn_id;
		function __construct($table_name)
		{
			parent::__construct();
			$this->table_name = $table_name;
			$this->load->library('Connections');
			// $this->_assign_libraries();
			$this->conn_id = $this->connections->get_database_object();

		}


		function get_data($id = 0)
		{
			// if ( $id = 0 )
			// {
			$sql = $this->conn_id->query('select * from '.$this->table_name);

			$result = $sql -> fetchAll(PDO::FETCH_ASSOC);

			return $result;
			// }
		}

		

	}

	?>