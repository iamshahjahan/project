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
			$this->load->model('Question_tags');
			$this->load->library("session");
			$this->load->helper("url");

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
				// let us get all question related to this tag from table.
				$questions = $this->Question_tags->get_questions_by_tag_id($tag_id);


				$data  = array(
						'result' => $result,
						'questions' => $questions,
						 );
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