<?php 
	/**
	* 
	*/
	class Question_controller extends CI_Controller
	{
		
		function __construct()	
		{

			parent::__construct();
			$this->load->helper(array('form'));
			$this->load->library('form_validation');
			$this->load->helper('url');
			$this->load->helper('security');
			$this->load->model('Question_tags');
			$this->load->model('Questions');
			$this->load->model('Answers');
			$this->load->model('Users');
			$this->load->model('Follows');
			$this->load->model('Tags');

			if ( !is_logged_in() )
			{
				redirect('login',TRUE);
			}
		}

		function index()
		{
			$this->load->view("templates/header");
			$this->load->view("question_view");
			$this->load->view("templates/footer");
		}

		function get($q_id = null)
		{
			// echo $q_id;

			if ( $q_id != null )
			{
				if ( isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0)
				{
					$page = $_GET['page'];

					$offset = $page * 5;
				}
				else
				{
					$page = 0;
					$offset = 0;
				}

				// let us find the question detials
				
				$result = $this->Questions->get($q_id);
				
				// ge all answers to the above questions.
				$total_results = ($this->Answers->get_count_question_id($q_id));

				$answers = $this->Answers->get_by_question_id($q_id,$offset,$limit = 5);
				
				// Let us get user details of the user who answered the questions.

				$original_question_poster = $this->Users->get($result[0]['user_id']);

				// getting offsets for pagination.

				$tag_ids = $this->Question_tags->get_tag_id($q_id);

				$tags = array();
				// var_dump($tag_ids);

				foreach ($tag_ids as $tag_id) {
					// var_dump($tag_id);
					array_push($tags, $this->Tags->get($tag_id[0]));
				}

				// var_dump($tags);
				$data  = array(
					'result' => $result,
					'answers' => $answers,
					'tags' => $tags,
					'original_question_poster' => $original_question_poster,
					'total_results' => $total_results,
					'offset' => $offset,
					'page_name' => 'question/get/'.$q_id 
					);
				// $data = $result;
				if ( !$result )
				{
					echo "You supplied wrong question id.";
				}
				else
				{
					$this->load->view('templates/header',$data);
					$this->load->view('question_details',$data);
					// $this->load->view('tag_details',array('result'=>$tags));

					$this->load->view('templates/footer',$data);
					// var_dump($result);
				}
			}
			else
			{
				$this->load->view('templates/header');
				$this->load->view('verified_view',array('message' => 'The page doesn\'t exist'));
				$this->load->view('templates/footer');
				
			}
		}
	}
	?>