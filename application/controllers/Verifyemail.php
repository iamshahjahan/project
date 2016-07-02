<?php 
	/**
	* This class takes care of verifying the email id
	*/
	class Verifyemail extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model('Users');
		}

		function index()
		{
			$this->load->view('templates/header');
			if ( isset($_GET['key']))
			{
				$hash_key = $_GET['key'];

				$row = $this->Users->check_hash($hash_key);

				if ($row  != FALSE) 
				{
					if ( $row['is_active'] == 1 )
					{
						$this->load->view('verified_view',array('message'=>"You are already a verified user"));

					}
					else
					{
						if ( $this->Users->verify_success($row['user_id']) == TRUE )
						{
							$this->load->view('verified_view',array('message'=>"Successfully verified_view"));
							
						}
						else
						{
							$this->load->view('verified_view',array('message'=>"Something went wrong"));
						}
					}
				}
				else
				{
					$this->load->view('hash_key_not_found_view');
				}
				
			}
			else
			{
				$this->load->view('hash_key_not_found_view');
			}
			$this->load->view('templates/footer');
		}
	}


	?>