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
			$this->load->model('Questions');
			$this->load->model('Answers');
			$this->load->model('Users');
		}

		function index()
		{
			$this->load->view("templates/header");
			$this->load->view("question_view");
			$this->load->view("templates/header");
		}

		function get($q_id = null)
		{
			// echo $q_id;

			if ( $q_id != null )
			{
				// let us find the question detials
				
				$result = $this->Questions->get($q_id);
				
				// ge all answers to the above questions.

				$answers = $this->Answers->get_by_question_id($q_id);
				
				// Let us get user details of the user who answered the questions.

				$original_question_poster = $this->Users->get($result[0]['user_id']);


				$data  = array(
					'result' => $result,
					'answers' => $answers, 
					'original_question_poster' => $original_question_poster
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
					$this->load->view('templates/footer',$data);

					// var_dump($result);
				}
			}
			else
			{
				var_dump($this->Questions->get());
			}
		}
	}
	?>