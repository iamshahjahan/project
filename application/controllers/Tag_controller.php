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
			$this->load->model('Users');
			$this->load->library("session");
			$this->load->helper("url");
			if ( !is_logged_in() )
			{
				redirect('login',TRUE);
			}

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
				$count_followers = ($this->Follows->get_followers($tag_id));


				$data  = array(
					'result' => $result,
					'questions' => $questions,
					'count_followers' => $count_followers,
					);
				// $data = $result;
				if ( !$result )
				{
					echo "You supplied wrong question id.";
				}
				else
				{
					// var_dump($result);
					$this->load->view('templates/header');
					$this->load->view('tag_details',$data);
					$this->load->view('templates/footer');

				}
			}
			else
			{
				var_dump($this->Tags->get());
			}

		}
	}


	?>