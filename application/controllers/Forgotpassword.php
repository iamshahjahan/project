<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Forgotpassword extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Users');
		$this->load->library('email');
	}

	function index()
	{
		if (isset($_POST['forgotpassword_email']))
		{
				// setting the rules for form_validation using codeigniter

			$this->form_validation->set_rules('forgotpassword_email', 'Email', 'trim|required|valid_email|xss_clean');

				// running form_validation methods

			// initializa a response array
			$response = array();
			$response['success'] = 0;

			if ($this->form_validation->run() == TRUE)
			{

				$email = $_POST['forgotpassword_email'];
			 		// generating a random hash key for the activation of the link.
				if($name = $this->Users->userexist('email',$email))
				{
					$hash_key = md5(rand(1,100000));
					$data = array($email,$hash_key);

					if($this->Users->add_hash($data) == TRUE)
					{
						if ($this -> send_reset_mail($name,$email,$hash_key))
						{
							$response['success'] = 1;							
						}
						else
						{
							$response['message'] = "Unable to send email. Please try later.";
						}
					}
					else
					{
						$response['message'] = "Unable to generate hash key. Please contact web admin.";
					}
				}
				else
				{
					$response['message'] = "Your email doesn't exist.";
				}
			}

			else
			{
				// unable to validate. Enter some errors.
				$response['message'] = form_error('forgotpassword_email');
			}

		}
		// not a post requests
		else
		{
			$response['message'] = "Not a valid request.";
			
		}

		echo json_encode($response);

	}
	function send_reset_mail($username,$address,$hash_key)
	{
			// first create the link to be send to the user.
		$link = site_url() . '/resetpassword?email='.$address.'&key='. $hash_key;

			// subject to be send at the particular email ids
		$subject = 'Please reset your password for project.com';
			// message in which the link will be mentioned

		$message = 'Hi '.$username.'! Welcome to the project.com. Please reset your password by clicking the link: '.$link;

		$result = $this->email
		->from('jamiamentors@gmail.com')
		->to($address)
		->subject($subject)
		->message($message)
		->send();

		return $result;

	}

}

?>