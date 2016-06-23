<?php 
	/**
	* This class takes care of all register operations performed by the users
	*/
	class Register extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();	
		}

		function index()
		{
			// this function gets all data from user, name, email, mobile, password and confirm password and checks whether they are working accordingly or not?
			echo "Hello from register.";

		}
	}
	
	?>