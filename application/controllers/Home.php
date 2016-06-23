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
			$this->pdo = $this->load->database('pdo', true);
		}

		function index()
		{
			// displayting user details for check of the pdo working.
			$stmt = $this->pdo->get("users");  
			var_dump($this->pdo);			
			var_dump($stmt->result());
		}
	}
	?>