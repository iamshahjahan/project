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
			}

			function index()
			{
				$this->load->view('templates/header');
				$sess_data = $this->session->userdata('logged_in');
				$limit = 7;
				if($sess_data)
				{
					$data = $this->Users->get($sess_data['user_id']);
					echo 'logged in';
					$this->load->view('myprofile_view',$data[0]);//tab1
				$tgs = $this->Follows->get_tags($sess_data['user_id']);//tags
				$this->load->view('tag_view',array('tags'=>$tgs));
				//echo 'Your Public Profile';
				$this->get($data[0]['user_id']) ;//tab2 includes user recents that public views
				$tgs = $this->Follows->get_tags($sess_data['user_id']);//same tag_view for public profile
				$this->load->view('tag_view',array('tags'=>$tgs));
				$this->load->view('templates/footer');

			}
			else
			{
						//show public profile
				echo 'not logged in';
			 // $this->load->view('pubprofile_view',$data[0]);//to be resolved

			}
		}

		function edit()
		{
			$sess_data = $this->session->userdata('logged_in');
			if($sess_data){
				$data = $this->Users->get($sess_data['user_id'])[0];

				if (isset($_POST['submit']))
				{
						// setting the rules for form_validation using codeigniter

					$this->form_validation->set_rules('name', 'Name', 'required|min_length[1]');

					$this->form_validation->set_rules('mobileno', 'Mobile ', 'required|exact_length[10]');

					$this->form_validation->set_rules('about', 'Name', 'trim');


						// running form_validation methods

					if ($this->form_validation->run() == TRUE)
					{

						$name = $_POST['name'];
						$mob = $_POST['mobileno'];
						$about = $_POST['about'];

						if($this->Users->save(array($name,$mob,$about,$data['user_id'])))
						{
							echo 'Changes saved';
						}
						else
						{
							echo "Error saving changes";
						}
					}
					else
					{
						//redirect("profile",'refresh');    
						$this->load->view('myprofile_view',$data);
					}

				}
				else
				{
					echo "Unable to save";
				}
			}
			else
			{
				//show public profile
				echo 'not logged in';
				$this->load->view('profile_view'); 
			}
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
	 //  function recent_act($limit=7,$u_id=0)//limit 7 Ques and Ans 
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

	 function get($u_id, $limit = 7 ){//get/load specific profile
	 	$data = $this->Users->get($u_id);
	 	if($data!=0)
	 	{
	 		$this->load->view('pubprofile_view',$data[0]);
	 		$tgs = $this->Follows->get_tags($u_id);//tags
	 		$this->load->view('tag_view',array('tags'=>$tgs));    
	 		$this->recent_activity->recent_act($u_id,$limit);
	 	}
	 	else
	 	{
	 		echo "User does not exist";
	 	}
	 }
	}
	?>
