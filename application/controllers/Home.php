<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->helper('url');
   $this->load->model('Users');
   
 }
 
 function index()
 {
 	//print_r($this->Users->get());//shahjehan's
   if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     //$data['email'] = $session_data['email'];
     $this->load->view('home_view', $session_data);//send sess data
   }
   else
   {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
 }
 
 function logout()
 {
   $this->session->unset_userdata('logged_in');
   session_destroy();
   redirect('home', 'refresh');
 }
 
}
 

/**
	* This home controller does the tasks related to home page on the website.
	*/
	// class Home extends CI_Controller
	// {
		
	// 	function __construct()
	// 	{
	// 		parent::__construct();
	// 		//load the pdo db config 
	// 		// $this->pdo = $this->load->database('pdo', true);
	// 		$this->load->helper('url');
	// 		$this->load->model('Users');
	// 	}

	// 	function index()
	// 	{
	// 		print_r($this->Users->get());			
	// 	}

		
	// }
?>
