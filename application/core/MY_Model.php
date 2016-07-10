<?php 
	/**
	* The base table model where each and every table will get data from
	*/
	class MY_Model extends CI_Model
	{
		private $table_name;
		private $primary_key;
		protected $conn_id;

		public function __construct($table_name,$primary_key ="")
		{
			parent::__construct();
			$this->table_name = $table_name;
			$this->primary_key = $primary_key;
			$this->load->library('Connections');
			// $this->_assign_libraries();
			$this->conn_id = $this->connections->get_database_object();

		}


		public function get($id = 0,$limit=0)
		{
			try 
			{
				$limit_q = "";
				if($limit!=0)
				{	
					$limit_q = " limit ".$limit." ";
				}
				// it means we need to display all data from table.
				if ( $id == 0 )
				{
// change.
					$sql = $this->conn_id->query('select * from '.$this->table_name.$limit_q);

					$result = $sql -> fetchAll(PDO::FETCH_ASSOC);

					return $result;

				} 
				// now user passes a particular id to the table.
				else
				{
					// $q_id = ".$id.";
					$sql = $this->conn_id->query("select * from ".$this->table_name." where ".$this->primary_key ." = '".$id."'".$limit_q);

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

		/*
		* args - array of key, specify array() of ids else 0 (non array)
		*                       specify limit if order by time and limit results,
		*                       specify u_id if needed for that user,
		*                       specify field in order_by else '-1',
		*                       specify $key_id field in which ids are to be searched 
		*/
		public function get_by_key($key=0,$limit=0,$offset=0,$u_id=0,$order_by='-1',$key_id)
		{
			$sql_query = "select * from ".$this->table_name." ";
			if(is_array($key) || $u_id!=0)
			{
				$sql_query = $sql_query ." where ";
			}

			if($u_id!=0)
			{
				$sql_query = $sql_query."user_id = ".$u_id." ";
			}

			if(is_array($key) && $u_id!=0)
			{
				$sql_query = $sql_query ." and ";
			}
			if(is_array($key))
			{	
				$sql_query = $sql_query." ".$key_id." in (";

				$x = 0;
				for (; $x < count($key) - 1; $x++) {
					$sql_query = $sql_query."'".$key[$x]."',";
				}
				$sql_query = $sql_query."'".$key[$x]."')";	
				
			}

			if($order_by!='-1')
			{
				$sql_query = $sql_query." order by ".$order_by." desc ";
			}

			if($limit!=0)
			{
				$sql_query = $sql_query." limit ".$limit." offset ".$offset;
			}
			
			// echo $sql_query;

			$sql = $this->conn_id->query($sql_query);
			if($result = $sql -> fetchAll(PDO::FETCH_ASSOC))
				return $result;
			else
				return 0;
		}


	}

	?>