<?php 
	/**
	* This class takes care of all register operations performed by the users
	*/
	class Verifyregister extends CI_Controller
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
			// var_dump($_POST);
			if (
				($this->input->post('name') != null ) 
				&& 
				($this->input->post('mobileno') != null) 
				&&
				($this->input->post('email') != null ) 
				&& 
				($this->input->post('password') != null) 
				&&
				($this->input->post('confirm_password') != null) 
				)
			{
				// setting the rules for form_validation using codeigniter

				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');

				$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[6]');

				$this->form_validation->set_rules('name', 'Name', 'required|min_length[1]');

				$this->form_validation->set_rules('mobileno', 'Mobile ', 'required|exact_length[10]');


				$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');				

				// running form_validation methods

				if ($this->form_validation->run() == FALSE)
				{
					$response = array(
						'name' => form_error('name'), 
						'email' => form_error('email'), 
						'mobileno' => form_error('mobileno'), 
						'password' => form_error('password'), 
						'confirm_password' => form_error('confirm_password'), 
						'success' => 0						);
				}
				// post data is valid. prepare data for next step
				else
				{

					$hash_key = md5(rand(1,100000));
					$data = array(
						$this->input->post('name'),
						$this->input->post('email'),
						$this->input->post('mobileno'),
						'/',
						// the password is one way hashed to ensure no privacy issues.
						md5($this->input->post('password')),
						// a random number for generating links for 
						$hash_key
						);



					// let us check whether email already exists in the table.
					$email_exists = $this->Users->userexist('email',$this->input->post('email'));
					$mobile_exists = $this->Users->userexist('mobileno',$this->input->post('mobileno'));

					if ( !$email_exists && !$mobile_exists)
					{
						// now insert the data into database.

						if($this->Users->insert($data) == TRUE)
						{

							// set success.
							$response = array(
								'success' => 1
								);
							// now send the verification mail to the email
							if ($this -> send_verification_mail($this->input->post('name'),$this->input->post('email'),$hash_key))
							{
								// set to check whether verification email has been sent or not.
								$response['email'] = $this->input->post('email');
							}
						}
						else
						{
							// otherwise the insertion in the database was unsuccessful.
							$response = array(
								'success' => 0,
								'message' => "Unable to insert data into database."
								);

						}	
					}
					else
					{
						$response = array(
							'success' => 0,
							);
						// if mobile exists, set the message.
						if ( $mobile_exists)
							$response['mobileno'] = 'The mobile number exists already.';
						// if email exists, set the message.
						if ( $email_exists)
							$response['email'] = 'The email id exists already.';
					}
					
				}
				echo json_encode($response);

			}
			else
			{
				
				$response = array(
					'success' => 0,
					'message' => "Please send us the post request."
					);
			}
		}
		function resend_verification_mail()
		{
			$username = $this->session->userdata('logged_in')['name'];
			$email = $this->session->userdata('logged_in')['email'];
			$hash_key = md5(rand(1,1000000)	);
			$data = array();

			array_push($data, $email);
			array_push($data, $hash_key);

			$response['success'] = 0;


			// adding hash key to the table
			if ( $this->Users->add_hash($data) == TRUE )
			{
				// let us send the verification key
				if ($this->send_verification_mail($username,$email,$hash_key))
				{
					$response['success'] = 1;
				}
				else
				{
					$response['message'] = "Unable to send verification mail.";
				}

			}
			else
			{
				$response['message'] = "Something went wrong. Please contact web admin.";
			}
			echo json_encode($response);
		}
		function send_verification_mail($username,$address,$hash_key)
		{
			// first create the link to be send to the user.
			$link = site_url() . '/verifyemail?key='. $hash_key;

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