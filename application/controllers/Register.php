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
			$this->load->helper(array('form'));

			$this->load->library('form_validation');
		}

		function index()
		{
			if (isset($_POST['submit']))
			{
				
				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');

				$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

				$this->form_validation->set_rules('name', 'Name', 'required|min_length[6]');

				$this->form_validation->set_rules('mobileno', 'Mobile ', 'required|length[10]');


				$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');				


				if ($this->form_validation->run() == TRUE)
				{
					$data = array(
						$_POST['name'],
						$_POST['email'],
						$_POST['mobileno'],
						'/',
						md5($_POST['password']),
						md5(rand(1,1000))
						);

					$this->Users->insert($data);
					if($this->Users->insert($data))
					{
						echo "Inserted successfully.";
					}
					else
					{
						echo "Unable to success.";
					}
				}

				else
				{
					$this->load->view('register');
				}
				
			}
			else
			{
				$this->load->view('register');
			}
		}
	}
	
	?>