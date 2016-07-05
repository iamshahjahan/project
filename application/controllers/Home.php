<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Users');   
		$this->load->library('Recent_Activity');
		$this->load->library('Sessionlibrary');
		if ( !is_logged_in() )
		{
			redirect('login',TRUE);
		}
	}
	
	function index()
	{
	//print_r($this->Users->get());//shahjehan's
		
		 $this->load->view('templates/header');//send sess data

		 // let us get all home data from the table.

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



		 $this->recent_activity->recent_act(0,5,$offset);


		 $count_questions = count($this->Questions->get_by_key(0,0,0,0,'creation_time','q_id'));
		 $count_answers = count($this->Answers->get_by_key(0,0,0,0,'answer_time','a_id'));
		// total results, will be used for pagination.
		 $total_results = $count_questions + $count_answers;

		 $this->load->view('pagination_view',
		 	array(
		 		'total_results' => $total_results,
		 		'offset' => $offset,
		 		'page_name' => 'home')
		 	);

		 $this->load->view('templates/footer');//send sess data

		}
	// moving logout function to session library.
		function logout()
		{
			$this->sessionlibrary->destroy_session();
			redirect('home', 'refresh');
		}

	}
	?>
