<?php 
	/**
	* The base table model where each and every table will get data from
	*/
	class MY_Model extends CI_Model
	{
		private $table_name;
		private $primary_key;
		protected $conn_id;
		function __construct($table_name,$primary_key ="")
		{
			parent::__construct();
			$this->table_name = $table_name;
			$this->primary_key = $primary_key;
			$this->load->library('Connections');
			// $this->_assign_libraries();
			$this->conn_id = $this->connections->get_database_object();

		}


		function get($id = 0)
		{
			try 
			{
				// it means we need to display all data from table.
				if ( $id == 0 )
				{

					$sql = $this->conn_id->query('select * from '.$this->table_name);

					$result = $sql -> fetchAll(PDO::FETCH_ASSOC);

					return $result;

				} 
				// now user passes a particular id to the table.
				else
				{
					// $q_id = ".$id.";
					$sql = $this->conn_id->query("select * from ".$this->table_name." where ".$this->primary_key ." = '".$id."'");

					// echo "select * from ".$this->table_name." where ".$this->primary_key ." = '".$id."'";

					if ( $result = $sql -> fetchAll(PDO::FETCH_ASSOC) )
					{
						return $result;
					}
					else
					{
						// echo "there are not results with id: ".$id;
						return 0;
					}
				}


			}
			catch (Exception $e) 
			{
				return 0;
			}
		}

		//  	// }



	}

	?>