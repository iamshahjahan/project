<?php 
	/**
	* this is a user table
	*/
	class Users extends MY_Model
	{
		
		function __construct()
		{
			parent::__construct('users','user_id');
			$this->load->library('Connections');
			// $this->_assign_libraries();
			$this->conn_id = $this->connections->get_database_object();

		}

		function userexist($email) //for forgot password
		{
			$query = $this->conn_id->prepare("select name from users where email = :email");
			if ( $query->execute(array(':email' => $email)) == TRUE ){
				$row = $query->fetch();
				if ( isset($row['name']))
				{
					return $row['name'];
				}
				else
					return 'FAL';
			}
			else
			{
				return "Query execution failed!";
			}

		}

		function add_hash($data)
		{
			$statement = $this->conn_id->prepare("update users set hash_key  = :hash_id where email = :email_id");///////////////
			return $statement->execute(array(':hash_id' => $data[1],':email_id' => $data[0]));
		}

		function check_hash($hash_key)
		{
			$statement = $this->conn_id->prepare("select user_id from users where hash_key = :hash_key");//also check corresponding email
			$statement->execute(array(':hash_key' => $hash_key));
			$row = $statement->fetch(); 	
			if (isset($row['user_id']))
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}

		function reset_pass($email,$pass)
		{
			$statement = $this->conn_id->prepare("update users set passwd  = :pass_id where email = :email_id");
			return $statement->execute(array(':pass_id' => $pass,':email_id' => $email));
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
			$statement = $this->conn_id->prepare("select user_id,is_active from users where hash_key = :hash_key");//also check corresponding email
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

		function login($email, $password)
		{
			$query = $this->conn_id->query("select user_id,email from users where email = " . "'".$email."'" ." and passwd = '".md5($password)."' limit 1;");
			$result = $query -> fetchAll(PDO::FETCH_ASSOC);
			
			if(count($result)  == 1)
			{
				return $result;
			}
			else
			{
				return false;
			}
		}

	}

	?>