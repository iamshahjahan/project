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
		$limit = 7;


		// get user id from session
		$data = $this->Users->get($this->session->userdata('logged_in')['user_id']);

		// var_dump($data);
		// load the profile view.
		$this->load->view('myprofile_view',$data[0]);

		// get the list of all tags followed by the user.
		$tags = $this->Follows->get_tags($this->session->userdata('logged_in')['user_id']);//tags
		
		// pass into an array.
		$this->load->view('tag_view',array('tags'=>$tags));

		// $this->get($data[0]['user_id']) ;
		// $tags = $this->Follows->get_tags($this->session->userdata('logged_in')['user_id']);//same tag_view for public profile
		// $this->load->view('tag_view',array('tags'=>$tags));
		// get the current user profile.

		$this->recent_activity->recent_act($this->session->userdata('logged_in')['user_id'],$limit);



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

	 //  /* 
	 //  * show user specific recent activities if 'loggedin' session set,or _arg$1 else global recent
	 //  */
	 //  function recent_act($limit=7,$user_id=0)//limit 7 Ques and Ans 
	 //  {
	 //      $this->load->model('Questions');
	 //      $this->load->model('Answers');
	 //      // $sess_data = $this->session->userdata('logged_in');
	 //      // $u_id = "";
	 //      // if($sess_data || $u_id){//show user specific recent activiteies
	 //      //     if($sess_data){
	 //      //         $u_id = $sess_data['user_id'];
	 //      //     }
	 //      //     else{
	 //      //         $u_id = $_GET['user_id'];
	 //      //     }
	 //          //$u_id = $sess_data['user_id'];
	 //          $ques = $this->Questions->get_by_key(0,$limit,$u_id,'creation_time','q_id');
	 //      //count anss
	 //          $ans = $this->Answers->get_by_key(0,$limit,$u_id,'answer_time','a_id');



	 //          //print_r($ques);
	 //          $qid_of_ans = array_column($ans, 'q_id');
	 //          //print_r($qid_of_ans);
	 //          //echo '</br>';

	 //          $ansdata = array(array());
	 //          $temp = array(array());

	 //          $x=0;
	 //          foreach ($qid_of_ans as $qid) {
	 //              $temp[$x] = $this->Questions->get($qid,$limit)[0];
	 //              $temp[$x]['q_u_id']= $temp[$x]['user_id'];
	 //              $ansdata[$x]=array_merge($temp[$x],$ans[$x]);
	 //              $x = $x + 1;
	 //          }

	 //          //print_r($temp);

	 //          //echo '</br>';

	 //          //print_r($ansdata);
	 //          //echo '</br>';


	 //          //echo '</br>';
	 //          //print_r($ques);
	 //          //echo '</br>';
	 //          //echo '</br>';
	 //          //print_r($ans);
	 //          //print_r(array_merge($ansdata,$ques));
	 //          $final_data=array_merge($ansdata,$ques);

	 //          function comp($a, $b) {
	 //              $ts1 = strtotime($a['creation_time']);
	 //              $ts2 = strtotime($b['creation_time']);
	 //              return $ts2 - $ts1;
	 //          }
	 //          usort($final_data, 'comp');
	 //          // foreach ($final_data as $key => $row) {
	 //          //     $dates[$key]  = $row['creation_time'];
	 //          // }
	 //          // print_r($dates);
	 //          // $disp=array_multisort($dates, SORT_DESC, $final_data);
	 //          //echo '</br>';
	 //          //echo '</br>';
	 //          //return $final_data;
	 //          $this->load->view('recent_act',array('finaldata'=>$final_data));
	 //     //  }
	 //     //  else
	 //     //  {
	 //     //  //show public profile
	 //     //     echo 'not logged in';
	 //     //     $this->load->view('pub_profile_view'); 
	 //     // }
	 // }

	function get($user_id , $limit = 7 )

	{
	 	// let us get the profile of a person using his/her user_id

		$data = $this->Users->get($user_id);
		if($data!=0)
		{
	 		// let us show his public profile
			$this->load->view('pubprofile_view',$data[0]);
	 		// now show the tags he follows/unfollows
			$tags = $this->Follows->get_tags($user_id);
			$this->load->view('tag_view',array('tags'=>$tags));
		    // let us display his/her recent activities. 
			$this->recent_activity->recent_act($user_id,$limit);
		}
		else
		{
			echo "User does not exist";
		}
	}
}
?>
