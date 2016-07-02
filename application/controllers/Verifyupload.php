
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifyupload extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->Model("Users");
	}


	public function index()
	{

		if(isset($_FILES['image']))
		{
			// echo "I am in files.";
			// set file name as user id			
			$file_name = $this->session->userdata('logged_in')['user_id'];

			$file_size =$_FILES['image']['size'];
			$file_tmp =$_FILES['image']['tmp_name'];
			$file_type=$_FILES['image']['type'];
			$temp = explode('.',$_FILES['image']['name']);
			$file_ext=strtolower(end($temp));

			$expensions= array("jpeg","jpg","png");

			$response['success'] = 0;

			if(in_array($file_ext,$expensions) === false){
				$response['message']="Extension not allowed, please choose a JPEG or PNG file.";
			}

			if($file_size > 2097152){
				$response['message']='File size must be excately 2 MB';
			}
			
			// if message is not set, means everything is fine.

			if(!array_key_exists('message', $response))
			{
				if(file_exists('/var/www/html/project/assets/images/'.$file_name.".".$file_ext)) 
				{
				    chmod('/var/www/html/project/assets/images/'.$file_name.".".$file_ext,0755); //Change the file permissions if allowed
				    unlink('/var/www/html/project/assets/images/'.$file_name.".".$file_ext); //remove the file
				}

				if ( move_uploaded_file($file_tmp,'/var/www/html/project/assets/images/'.$file_name.".".$file_ext) )
				{

					if($this->Users->setImagePath(array($this->session->userdata('logged_in')['user_id'],$file_name.".".$file_ext)))
					{	
						$response['success'] = 1;
					}
					else
					{
						$response['success'] = 0;
					}
				}
				else
				{
					$response['message']="Unable to save data to the server.";
				}

			}
		}
		else
		{
			$response['message'] = "Please upload a file.";
		}
		echo json_encode($response);
	}

	
}

/* End of file Upload.php */
/* Location: ./application/controllers/Upload.php */
?>