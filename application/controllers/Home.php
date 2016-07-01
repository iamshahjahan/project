<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Users');   
		$this->load->library('Recent_Activity');
		$this->load->library('Sessionlibrary');
	}
	
	function index()
	{
	//print_r($this->Users->get());//shahjehan's
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
		 //$data['email'] = $session_data['email'];
		 $this->load->view('templates/header');//send sess data
		 $this->load->view('home_view', $session_data);//send sess data
		 // //echo "Recent Question and Answers";
		 // $this->recent_activity->recent_act();
		 // var_dump($this->session->userdata('logged_in'));
		 $this->load->view('templates/footer');//send sess data
		}
		else
		{
			redirect('login', 'refresh');
		}
	}
	// moving logout function to session library.
	function logout()
	{
		$this->sessionlibrary->destroy_session();
		redirect('home', 'refresh');
	}
	
}
?>
