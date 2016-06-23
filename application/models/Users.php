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

		function send_verification_mail($username,$address,$hash_key)
		{
			// first create the link to be send to the user.
			$link = base_url() + '/verifyemail.php?key='+ $hash_key;
			// subject to be send at the particular email ids
			$subject = 'Verify your email id for project.com';
			// message in which the link will be mentioned

			$message = 'Hi '.$username.'! Welcome to the project.com. Please verify your email by clicking the link: '.$link;



		}

	}

	?>

