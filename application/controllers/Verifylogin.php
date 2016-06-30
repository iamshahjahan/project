<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class VerifyLogin extends CI_Controller 
{

	function __construct()
	{
		parent::__construct();
	 $this->load->model('Users','',TRUE);//args
	 $this->load->library('form_validation');
	 $this->load->library('Sessionlibrary');
	}

	function index()
	{
			 //This method will have the credentials validation

		if (($this->input->post('email') != null ) && ($this->input->post('password') != null))
		{
			$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

			if($this->form_validation->run() == FALSE)
			{
				$response = array(
					'email' => form_error('email'), 
					'password' => form_error('password'), 
					'success' => 0
					);
			}
			else
			{
				$email = $this->input->post('email');
				$password = $this->input->post('password'); 

				if ( $this->check_database($email,$password))
				{
						// login is successful.
					$response = array(
						'success' => 1, 
						);

				}
				else
				{
					$response = array(
						'success' => 0,
						'message' => 'Please  enter a valid email and password combination.' 
						);

				}
			}

		}

		else
		{
			$response = array(
				'success' => 0,
				'message' => "Email and password is not set."
				);
		}
		echo json_encode($response);
	}


	function check_database($email,$password)
	{

// check for login credentials.

		$result = $this->Users->login($email, $password);

		if($result)
		{

			$data = array(
				'user_id' => $result[0]['user_id'],
				'email' => $result[0]['email'],  
				'is_active' => $result[0]['is_active'],  
				);
			// call set session to set the current session.
			if ( $this->sessionlibrary->set_session($data) )
			{
				return TRUE;
			}
			
		}

		else
		{
			$this->form_validation->set_message('check_database', 'Invalid email or password');
			return FALSE;
		}
	}
}
?>
