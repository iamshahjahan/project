 <?php
 defined('BASEPATH') OR exit('No direct script access allowed');

 class Verifyresetpassword extends CI_Controller {
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->helper('url');
 		$this->load->model('Users');
 		$this->load->helper(array('form'));
 		$this->load->library('form_validation');
 		$this->load->library('email');
 	}

 	public function index()
 	{
 		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
 		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean|matches[password]');
 		$response['success'] = 0;

 		if($this->form_validation->run())
 		{
				if($this->Users->reset_pass($this->input->post('email'),md5($this->input->post('password'))))//md5 should be applied at view confirmpass for security
				{
					$this->Users->add_hash(array($this->input->post('email'),md5(rand(1,1000000))));//so that link expires->string 'NULL'
					$response['success'] = 1;
				}
				else
				{
					$response['message'] = "Unable to reset password.Please contact web admin.";
				}
			}
			else
			{
				$response['password'] = form_error('password');
				$response['confirm_password'] = form_error('confirm_password');
			}
			echo json_encode($response);
		}


	}

	/* End of file Verifyresetpassword.php */
	/* Location: ./application/controllers/Verifyresetpassword.php */ ?>