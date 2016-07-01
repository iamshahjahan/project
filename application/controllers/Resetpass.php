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
				if($this->Users->check_hash($hash_key)==TRUE)
				{
					$this->load->view('templates/header');
					$this->load->view('confirmpass',array('email'=>$email));
					$this->load->view('templates/footer');
					
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
				if($this->Users->reset_pass($this->input->post('email'),md5($this->input->post('password')))==TRUE)//md5 should be applied at view confirmpass for security
				{
					$this->Users->add_hash(array($this->input->post('email'),'NULL'));//so that link expires->string 'NULL'
					echo "Password Reset Successfull";//add code for Ridirect after 5s wait
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