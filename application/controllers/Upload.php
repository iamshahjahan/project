<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
	}
	function index()
	{
		if ( ($this->session->userdata("logged_in")) != null )
		{
			$this->load->view('templates/header');
			$this->load->view('upload_image');
			$this->load->view('templates/footer');	
		}
		else
		{
			redirect('login',true);
		}
	}
}

/* End of file Upload.php */
/* Location: ./application/controllers/Upload.php */
?>