<?php 

	/**
	* This home controller does the tasks related to home page on the website.
	*/
	class Home extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			//load the pdo db config 
			// $this->pdo = $this->load->database('pdo', true);
			$this->load->helper('url');
			$this->load->model('Users');
		}

		function index()
		{
			print_r($this->Users->get());			
		}

		
	}
	?>
