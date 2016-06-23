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
			return $query->execute($data);
		}

		function verify_success($user_id)
		{
			$statement = $this->conn_id->prepare("update users set is_active = 1 where user_id = :user_id");
			return $statement->execute(array(':user_id' => $user_id));
		}


		function check_hash_key($hash_key)
		{
			$statement = $this->conn_id->prepare("select user_id,is_active from users where hash_key = :hash_key");
			$statement->execute(array(':hash_key' => $hash_key));
			$row = $statement->fetch(); // Use fetchAll() if you want all results, or just iterate over the statement, since it implements Iterator	
			if (isset($row['user_id']))
			{
				if ( $row['is_active'] == 1 )
				{
					echo "You are already a verified user.";
				}
				else
				{
					if ( $this->verify_success($row['user_id']) == TRUE )
					{
						echo "Now you are verified user.";
					}
					else
					{
						echo "Something went wrong man.";
					}
				}
			}
			else
			{
				echo "Looks like the key doesn't exist.";
			}
		}

	}

	?>

