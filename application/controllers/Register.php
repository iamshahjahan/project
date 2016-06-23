<?php 
	/**
	* This class takes care of all register operations performed by the users
	*/
	class Register extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();	
			$this->load->helper('url');
			$this->load->model('Users');
		}

		function index()
		{
			if ( isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['mobileno']))
			{
				// $data = $this->input->post();
				
				$data = array(
					$_POST['name'],
					$_POST['email'],
					$_POST['mobileno'],
					'/',
					$_POST['password'],
					md5($_POST['password'])
					);

				$this->Users->insert($data);
				echo "Please check your mail for verification.";
			}
			else
			{
				echo "I am in view.";
				$this->load->view('register');
			}
		}
	}
	
	?>