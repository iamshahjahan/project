<?php 
	/**
	* Controller for
	*/
	class Tag_controller extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model('Tags');
			$this->load->model('Follows');
			$this->load->library("session");

		}

		function index()
		{
			echo "I am in tag.";
		}
		function get($tag_id = null )
		{
			if ( $tag_id != null )
			{

				$result = $this->Tags->get($tag_id);

				$data  = array('result' => $result );
				// $data = $result;
				if ( !$result )
				{
					echo "You supplied wrong question id.";
				}
				else
				{
					var_dump($result);
					$this->load->view('tag_details',$data);

				}
			}
			else
			{
				var_dump($this->Tags->get());
			}

		}
	}


	?>