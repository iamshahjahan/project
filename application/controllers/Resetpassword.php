<?php 
	/**
	* This class takes care of resetting the email id
	*/
	class Resetpassword extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model('Users');
//			$this->load->helper(array('form'));
			$this->load->library('form_validation');
		}

		function index()
		{
			if ( isset($_GET['key']) && isset($_GET['email']))
			{
				$hash_key = $_GET['key'];
				$email = $_GET['email'];


				if($this->Users->check_hash($hash_key) != FALSE)
				{
					$this->load->view('templates/header');
					$this->load->view('resetpassword_view',array('email'=>$email));
					$this->load->view('templates/footer');
					
				}
				// if hash key is not found, load hash_key_not_found_view
				else
				{
					$this->load->view('templates/header');
					$this->load->view('hash_key_not_found_view');
					$this->load->view('templates/footer');	
				}
			}
			else
			{
				$this->load->view('templates/header');
				$this->load->view('hash_key_not_found_view');
				$this->load->view('templates/footer');	
			}
		}


	}
	?>