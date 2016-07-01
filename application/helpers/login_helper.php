<?php 
function is_logged_in() 
{
    // Get current CodeIgniter instance
	$CI =& get_instance();
    // We need to use $CI->session instead of $this->session
	$user = $CI->session->userdata('logged_in')['is_active'];
	if ($user == 1 ) 
	{ 
		return true;
	}
	else 
	{
		return false; 
	}
}


?>