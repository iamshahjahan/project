<?php 
	/**
	* Answer controller is here
	*/
	class Verifyanswer extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model("Answers");
			$this->load->model("Questions");
			$this->load->model("Users");
			$this->load->library('email');
			$this->load->helper(array('form'));
			$this->load->library('form_validation');
			$this->load->helper('url');

		}
		function index()
		{
			// var_dump($_POST);
			if ( isset($_POST['user_id']) && isset($_POST['q_id']) && isset($_POST['answer']))
			{
				// now we need to add this answer to the database.
				$data = array(
					$_POST['q_id'],
					$_POST['user_id'],
					$_POST['answer']

					);
				// call a method to put array in the database.

				$response['success'] = 0;

				$this->form_validation->set_rules('answer', 'answer', 'trim|required|xss_clean|min_length[50]');

				if($this->form_validation->run())
				{
					if ( $this->Answers->insert($data) )
					{
					// now if the query runs successfully, just display the data to user with success message.

					// now send mail to each contributer of the question.

					// var_dump();
					// this array will consists of all users email list
						$user_email_list = array();

					// get details of the question.

						$queston_details = $this->Questions->get($_POST['q_id']);

					// making title and link to be send to the user.
						$title = $queston_details[0]['title'];
						$link = site_url().'/question/get/'.$_POST['q_id'];

						$message = "A new answer has been added to the question: ".$title.". Click here to visit: ".$link;

					// grabbing details of teh user who posted the question.
						if ( $_POST['user_id'] != $queston_details[0]['user_id'])
						{
							$user_details = $this->Users->get($queston_details[0]['user_id']);

					// add in the array 
							array_push($user_email_list, $user_details[0]['email']);
						}

					// now grab all users who answered the question.

						$answer_details = $this->Answers->get_by_question_id($_POST['q_id']);
					// $i = 0;
						if ($answer_details )
						{
							foreach ($answer_details as $answer) 
							{
						// check whether current user email id is there.
								if ( $answer['user_id'] != $_POST['user_id'])
									$user_details = $this->Users->get($answer['user_id']);

					// add in the array if not exists already. 

								if ( isset($user_details) && !in_array($user_details[0]['email'], $user_email_list))
									array_push($user_email_list, $user_details[0]['email']);

							}
						}

					// now send mail to each and every person.
						foreach ($user_email_list as $email) {
							$result = $this->email
							->from('jamiamentors@gmail.com')
							->to($email)
							->subject("New activity on project.com")
							->message($message)
							->send();

						}


						$response['success'] = 1;
						$response['email_lists'] = $user_email_list;
					}
					else
					{
						$response['message'] = "Unable to insert data into database.";
					}

				}
				else
				{
					$response['message'] = form_error('answer');
				}
			}
			else
			{
				$response['message'] = "Invalid request.";

			}
			echo json_encode($response);
		}
	}


	?>