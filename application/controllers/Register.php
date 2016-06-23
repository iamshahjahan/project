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
			$this->load->library('email');

		}

		function index()
		{
			if (isset($_POST['submit']))
			{
				// setting the rules for form_validation using codeigniter

				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');

				$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

				$this->form_validation->set_rules('name', 'Name', 'required|min_length[1]');

				$this->form_validation->set_rules('mobileno', 'Mobile ', 'required|exact_length[10]');


				$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');				

				// running form_validation methods

				if ($this->form_validation->run() == TRUE)
				{

					$email = $_POST['email'];
					$name = $_POST['name'];
					
					// generating a random hash key for the activation of the link.

					$hash_key = md5(rand(1,1000));
					
					$data = array(
						$name,
						$email,
						$_POST['mobileno'],
						'/',
					// the password is one way hashed to ensure no privacy issues.
						md5($_POST['password']),
						$hash_key
						);

					// 
					if($this->Users->insert($data))
					{
						echo "Inserted successfully.";

						if ($this -> send_verification_mail($name,$email,$hash_key))
						{
							echo "The mail has been sent to your email ".$email.". Please verify your email to proceed.";
						}
						else
						{
							echo "Something went wrong.";
						}
					}
					else
					{
						$this -> send_verification_mail($name,$email,$hash_key);
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

		function send_verification_mail($username,$address,$hash_key)
		{
			// first create the link to be send to the user.
			$link = site_url() . '/verifyemail.php?key='. $hash_key;

			echo $link;
			// subject to be send at the particular email ids
			$subject = 'Verify your email id for project.com';
			// message in which the link will be mentioned

			$message = 'Hi '.$username.'! Welcome to the project.com. Please verify your email by clicking the link: '.$link;

			$result = $this->email
			->from('jamiamentors@gmail.com')
			->to($address)
			->subject($subject)
			->message($message)
			->send();

                // var_dump($result);
                // echo '<br />';
                // echo $this->email->print_debugger();
			return $result;

		}
	}
	
	?>