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
		if (isset($_POST['submit']))
		{
				// setting the rules for form_validation using codeigniter

			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');

				// running form_validation methods

			if ($this->form_validation->run() == TRUE)
			{

				$email = $_POST['email'];
			 		// generating a random hash key for the activation of the link.
				if($this->Users->userexist($email) != 'FAL')
				{
					$hash_key = md5(rand(1,100000));
					$data = array($email,$hash_key);
					if($this->Users->add_hash($data) == TRUE)
					{
						if ($this -> send_reset_mail($this->Users->userexist($email),$email,$hash_key))
						{
							echo "Password reset mail has been sent to your email at ".$email;
						}
						else
						{
							echo "Something went wrong while sending you a mail.";
						}
					}
					else
					{
						echo "Something went wrong while generating hash.";
					}
				}
				else
				{
					echo 'We could not find your email. Please ';
					echo '<a href="register">Register</a>.';
				}
			}

			else
			{
				$this->load->view('forgotpassword');
			}

		}
		else
		{
			$this->load->view('forgotpassword');
		}

	}
	function send_reset_mail($username,$address,$hash_key)
		{
			// first create the link to be send to the user.
			$link = site_url() . '/resetpass?email='.$address.'&key='. $hash_key;

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