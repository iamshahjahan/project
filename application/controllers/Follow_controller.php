<?php 
	/**
	* 
	*/
	class Follow_controller extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model("Follows");
		}
		function index()
		{
			// var_dump($_POST);
			if ( isset($_POST['tag_id']) && isset($_POST['user_id']))
			{
				// echo "tag is set.";
				$response['success'] = 0;

				$data = array($_POST['tag_id'],$_POST['user_id']);
				// var_dump($data);

				if ( isset($_POST['unfollow']))
				{
					if ( $this->Follows->delete($data))
					{
						
						$response['success'] = 1;

					}
					else
					{
						$response['message'] = "Unable to set unfollow option.";

					}
					
				}
				else
				{
					if ( $this->Follows->insert($data))
					{
						$response['success'] = 1;
					}
					else
					{
						$response['message'] = "Unable to set follow option.";

					}
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