<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifyquestion extends CI_Controller {

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
		$this->load->model('Tags');
		$this->load->model('Question_tags');
	}
	function index()
	{
		$database_error = false;
		if (isset($_POST['submit']))
		{

			// make an array to get json responses.

			$response['success'] = 0;



			// check for database error.

			$this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean|max_length[100]');

			$this->form_validation->set_rules('description', 'Question Description', 'trim|required|xss_clean|min_length[100]');

			$this->form_validation->set_rules('tag1', 'Tag 1', 'trim|required|min_length[1]');

			if($this->form_validation->run() == TRUE)
			{
				$tags = array();
				try 
				{
					foreach ($_POST as $key => $value) {

						if (0 === strpos($key, 'tag')) {
							if ( $value != " ")
								array_push($tags, $value);

						}
						elseif (0 === strpos($key,'description')) {
							$description = $value;
						}
						elseif (0 === strpos($key,'title')) {
							$title = $value;
						}

						else {
								// echo "Something is wrong with the post parameters.";
						}
					}
				} 
				catch (Exception $e) 
				{
						//show error messages.	
				}

				$data = array(
					$title,
					$description,
					$this->session->userdata('logged_in')['user_id']
					);

				// this variable is for future check of database error.
				$database_error = true;

				$response['tags'] = $tags;
				
				// question insertion is done here.
				$request = $this->Questions->insert($data);
				if ($request[0]==1)
				{
					$q_id = $request[1];
							// doubt : should load here or not
					
							// Todo : insert new tags in tags table.
					foreach ($tags as $tag) {
						$tag_id = $this->Tags->get_tagid($tag);

							// if no tag id -> insert in table
						if(!$tag_id)
						{
							$request = $this->Tags->insert($tag);
								if($request[0] == 1) // if tags inserted.
								{
									$tag_id = $request[1];
								}
							}
							if($this->Question_tags->insert($q_id, $tag_id))
							{
								$response['success'] = 1;
								$database_error = false;
							}
						}
					}
				}

				else //we have response errors.
				{
					$response['title'] = form_error('title');
					$response['description'] = form_error('description');
					$response['tag1'] = form_error('tag1');
				}
			}
			else
			{
				$response['message'] = "Invalid request.";
			}

			if ( $database_error)
			{
				$response['message'] = "Some error occured. Please contact your admin.";
			}

			echo json_encode($response);
		}

	}

	/* End of file verifyquestion.php */
	/* Location: ./application/controllers/verifyquestion.php */ ?>