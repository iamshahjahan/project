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
			echo "I am outside isset.";
			if ( isset($_POST['tag_id']) && isset($_POST['user_id']))
			{
				echo "tag is set.";

				$data = array($_POST['tag_id'],$_POST['user_id']);

				if ( isset($_POST['unfollow']))
				{
					if ( $this->Follows->delete($data))
					{
						
						$json_message = array(
							'success' => true, 
							);
						echo json_encode($json_message);
					}
					else
					{
						// echo "I am in else.";
						$json_message = array(
							'success' => false, 
							);
						echo json_encode($json_message);

					}
				}
				else
				{
					if ( $this->Follows->insert($data))
					{
						$json_message = array(
							'success' => true, 
							);
						echo json_encode($json_message);
					}
					else
					{
						$json_message = array(
							'success' => false, 
							);
						echo json_encode($json_message);

					}
				}

			}
			else
			{
				echo "tags are not set.";
				$json_message = array(
					'success' => false, 
					);
				echo json_encode($json_message);
			}
		}
	}

	?>