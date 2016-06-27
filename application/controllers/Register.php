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

					$hash_key = md5(rand(1,100000));
					
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
					if($this->Users->insert($data) == TRUE)
					{
						echo "Inserted successfully.";

						if ($this -> send_verification_mail($name,$email,$hash_key))
						{
							echo "The mail has been sent to your email ".$email.". Please verify your email to proceed.";
						}
						else
						{
							echo "Something went wrong while sending you a mail.";
						}
					}
					else
					{
						echo "Something went wrong while regiteration.";
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