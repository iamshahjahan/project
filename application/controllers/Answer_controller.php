<?php 
	/**
	* Answer controller is here
	*/
	class Answer_controller extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model("Answers");
		}
		function index()
		{
			echo "I am in index.";
		}
		function post_answer()
		{
			if ( isset($_POST['user_id']) && isset($_POST['q_id']) && isset($_POST['answer']))
			{
				// now we need to add this answer to the database.
				$data = array(
						$_POST['q_id'],
						$_POST['user_id'],
						$_POST['answer']

					);
				// call a method to put array in the database.

				if ( $this->Answers->insert($data) )
				{
					// now if the query runs successfully, just display the data to user with success message.

					$json_message = array(
									'success' => true, 
									);
					echo json_encode($json_message);
				}
				else
				{
					$json_message = array(
									'success' => false,
									'message' => "Unable to insert data into database."

									);
					echo json_encode($json_message);	
				}

			}
			else
			{
				$json_message = array(
									'success' => false,
									'message' => "All varaibles are not set."

									);
					echo json_encode($json_message);
			}
		}
	}


 ?>