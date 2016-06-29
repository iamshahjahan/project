<?php 
	/**
	* 
	*/
	class MY_Form_validation extends CI_Form_validation
	{

		protected $CI;

        // We'll use a constructor, as you can't directly call a function
        // from a property definition.
		function __construct( $config = array() )
		{
			parent::__construct($config);
			$this->CI =& get_instance();
		}



		public function email_check($email)
		{
			$this->CI->form_validation->set_message('email_check', 'The %s is not valid.');
            // echo "I am in email_check.";

			return false;
            // return $this->CI->form_validation->run();
		}

		public function password_check($password)
		{
			$this->CI->form_validation->set_message('password_check', 'The %s is not valid.');

			return true;
            // return $this->CI->form_validation->run();
		}

		public function username_check($name)
		{
			$this->CI->form_validation->set_message('username_check', 'The %s is not valid.');

			return true;
            // return $this->CI->form_validation->run();
		}
		
		public function mobile_check($mobileno)
		{
			$this->CI->form_validation->set_message('mobile_check', 'The %s is not valid.');

			return true;
            // return $this->CI->form_validation->run();
		}        
		public function register_validations($data)
		{
			$this->CI->form_validation->set_rules($data['email'], 'email', 'trim|required|valid_email|xss_clean|email_check');
			$this->CI->form_validation->set_rules($data['password'], 'Password', 'trim|min_length[6]|required|xss_clean|password_check');
			$this->CI->form_validation->set_rules($data['name'], 'Name', 'trim|required|min_length[1]|username_check');
			$this->CI->form_validation->set_rules($data['mobileno'], 'Mobile', 'required|exact_length[10]|mobile_check');
			$this->CI->form_validation->set_rules($data['confirm_password'], 'Confirm password', 'trim|required|matches[password]');
			return $this->CI->form_validation->run();
		}

	}
	?>