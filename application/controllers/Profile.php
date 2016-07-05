<?php 
class Profile extends CI_Controller 
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form'));
		$this->load->library('form_validation');
		$this->load->model('Users','',TRUE);//args
		$this->load->library('Recent_Activity');
		$this->load->model('Follows','',TRUE);

// let us check whether user is logged in or not?	
		if ( !is_logged_in() )
		{
			redirect('home',TRUE);
		}
	}

	function index()
	{
		$this->load->view('templates/header');
		$limit = 5;


		// get user id from session
		$data = $this->Users->get($this->session->userdata('logged_in')['user_id']);

		// load the profile view.
		$this->load->view('myprofile_view',$data[0]);

		// 	get all tags
		$tags = $this->Follows->get_tags($this->session->userdata('logged_in')['user_id']);//tags
		
		// here is the tag view
		$this->load->view('tag_view',array('tags'=>$tags));

		
		// here comes recent activity page, need to add pagination
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


		$this->recent_activity->recent_act($this->session->userdata('logged_in')['user_id'],$limit,$offset);

		// pagination view here.

		$count_questions = count($this->Questions->get_by_key(0,0,0,$this->session->userdata('logged_in')['user_id'],'creation_time','q_id'));
		$count_answers = count($this->Answers->get_by_key(0,0,0,$this->session->userdata('logged_in')['user_id'],'answer_time','a_id'));
		// total results, will be used for pagination.
		$total_results = $count_questions + $count_answers;

		$this->load->view('pagination_view',
			array(
				'total_results' => $total_results,
				'offset' => $offset,
				'page_name' => 'profile')
			);

		$this->load->view('templates/footer');
		
	}

	function changepass()
	{
		$sess_data = $this->session->userdata('logged_in');
		if($sess_data){
			$data = $this->Users->get($sess_data['user_id'])[0];

			if (isset($_POST['submit']))
			{
				$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
				if ($this->form_validation->run() == TRUE)
				{
					$result = $this->Users->login($data['email'], $_POST['password']);
					if($result)
					{
						$this->load->view('confirmpass',array('email'=>$data['email']));
					}
					else
					{
						echo "unable to verify";
					}
				}
				else
				{
					$this->load->view('changepass_view',array('email'=>$data['email']));//check
				}
			}//first time load this view
			else
			{ 
				$this->load->view('changepass_view',array('email'=>$data['email']));
			}
		}
		else
		{
			//show public profile
			echo 'not logged in';
			$this->load->view('login_view'); 
		}
	}
	function get($user_id , $limit = 5 )

	{

		// load the header

		$this->load->view('templates/header');


	 	// let us get the profile of a person using his/her user_id

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

		$data = $this->Users->get($user_id);
		if($data!=0)
		{
	 		// let us show his public profile
			$this->load->view('profile_view',$data[0]);
	 		// now show the tags he follows/unfollows
			$tags = $this->Follows->get_tags($user_id);
			$this->load->view('tag_view',array('tags'=>$tags));
		    // let us display his/her recent activities. 
			$this->recent_activity->recent_act($user_id,$limit,$offset);

			$count_questions = count($this->Questions->get_by_key(0,0,0,$user_id,'creation_time','q_id'));
			$count_answers = count($this->Answers->get_by_key(0,0,0,$user_id,'answer_time','a_id'));
		// total results, will be used for pagination.
			$total_results = $count_questions + $count_answers;

			$this->load->view('pagination_view',
				array(
					'total_results' => $total_results,
					'offset' => $offset,
					'page_name' => 'profile/get/'.$user_id)
				);
		}
		else
		{
			$this->load->view('verified_view',array('message' => 'The url doesn\'t exist. Please check the url'));
		}
		$this->load->view('templates/footer');
	}
}
?>
