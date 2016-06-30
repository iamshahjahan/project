<?php 

	/**
	* This is the class which manages all session data.
	*/
	class Sessionlibrary	
	{
		public function __construct() 
		{
			$this->CI =& get_instance();
			$this->CI->load->library("session");

		}

		public function set_session($data)
		{
			$sess_array = array(
				'user_id' => $data['user_id'],
				'email' => $data['email'],  
				'is_active' => $data['is_active']  
				);
	 // var_dump($sess_array);
			$this->CI->session->set_userdata('logged_in', $sess_array);
			return TRUE;	
		}	
	}
	

	?>