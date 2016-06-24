<?php 
	/**
	* This class takes care of resetting the email id
	*/
	class Resetpass extends CI_Controller
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
				echo "hash_key is:" .$hash_key."email is:" .$email;
				if($this->Users->check_hash($hash_key)==TRUE)
				{
					$this->load->view('confirmpass',array('email'=>$email));//////,matches
				}
				else
				{
					echo "Key not found.";
				}
			}
			else
			{
				echo "Something is not working fine here.";
			}
		}

		function commit()
		{
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password2', 'Password', 'trim|required|xss_clean|matches[password]');//add matches at application level also
			if($this->form_validation->run() == TRUE)
			{
				if($this->Users->reset_pass($this->input->post('email'),$this->input->post('password'))==TRUE)
				{
					echo "Password Reset Successfull";
				}
				else
				{
					echo "Something went wrong while resetting.";
				}
			}
			else
			{
				$this->load->view('confirmpass',array('email'=>$this->input->post('email')));
			}
		}
	}
?>