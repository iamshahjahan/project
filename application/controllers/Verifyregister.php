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
					if ( !$this->Users->userexist('email',$this->input->post('email')))
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
						// now the email id exists already.
						$response = array(
							'success' => 0,
							'email' => "The email id exists already. Please enter a different email id or login."
							);
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

		function upload()
		{
			if(isset($_FILES['image'])){
				$errors= array();
				$file_name = $_FILES['image']['name'];
				$file_size =$_FILES['image']['size'];
				$file_tmp =$_FILES['image']['tmp_name'];
				$file_type=$_FILES['image']['type'];
				$temp = explode('.',$file_name);
				$file_ext=strtolower(end($temp));

				$expensions= array("jpeg","jpg","png");

				if(in_array($file_ext,$expensions) === false){
					$errors[]="extension not allowed, please choose a JPEG or PNG file.";
				}

				if($file_size > 2097152){
					$errors[]='File size must be excately 2 MB';
				}

				if(empty($errors)==true){
					move_uploaded_file($file_tmp,'/var/www/html/project/assets/images/'.$file_name);
					//base_url().'assets/images/'.$file_name
					if($this->Users->setImagePath(array($this->session->userdata('logged_in')['user_id'],$file_name)))
					{	
						echo "Success";
					}
					else
						echo "Unable to set Image Path";
				}else{
					print_r($errors);
				}
			}
			else
			{
				$this->load->view('upload_image');
			}
		}

	}
	
	?>