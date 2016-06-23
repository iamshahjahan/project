<?php 
	/**
	* This class takes care of verifying the email id
	*/
	class Verifyemail extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model('Users');
		}

		function index()
		{
			if ( isset($_GET['key']))
			{
				$hash_key = $_GET['key'];
				echo "hash_key is:" .$hash_key;
				$this->Users->check_hash_key($hash_key);
				

			}
			else
			{
				echo "Something is not working fine here.";
			}
		}
	}


	?>