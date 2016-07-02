<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifyprofile extends CI_Controller 

{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Users');
	}

	public function index()
	{
		if (isset($_POST['submit']))
		{
					// setting the rules for form_validation using codeigniter

			$this->form_validation->set_rules('name', 'Name', 'required|min_length[1]');

			$this->form_validation->set_rules('mobileno', 'Mobile ', 'required|exact_length[10]|numeric');

			$this->form_validation->set_rules('about', 'About', 'trim');


					// running form_validation methods
			$response['success'] = 0;

			if ($this->form_validation->run() == TRUE)
			{

				$name = $_POST['name'];
				$mob = $_POST['mobileno'];
				$about = $_POST['about'];

				if($this->Users->save(array($name,$mob,$about,$this->session->userdata('logged_in')['user_id'])))
				{
					$response['success'] = 1;

				}
				else
				{
					$response['message'] = "Unable to save update your credentials.";
				}
			}
			else
			{
				$response['name'] = form_error('name');
				$response['mobileno'] = form_error('mobileno');
				$response['about'] = form_error('about');
			}

		}
		else
		{
			$response['message'] = "Invalid request.";	
		}
		echo json_encode($response);
	}


}

/* End of file Verifyprofile.php */
/* Location: ./application/controllers/Verifyprofile.php */ ?>