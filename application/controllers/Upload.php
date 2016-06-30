
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {
	
	public function index()
	{

		if(isset($_FILES['image'])){
			$errors= array();
			$file_name = $_FILES['image']['name'];
			$file_size =$_FILES['image']['size'];
			$file_tmp =$_FILES['image']['tmp_name'];
			$file_type=$_FILES['image']['type'];
			$temp = explode('.',$file_name);
			$file_ext=strtolower(end($temp));

			$expensions= array("jpeg","jpg","png");

			if(in_array($file_ext,$expensions) === false){
				$errors[]="extension not allowed, please choose a JPEG or PNG file.";
			}

			if($file_size > 2097152){
				$errors[]='File size must be excately 2 MB';
			}

			if(empty($errors)==true){
				move_uploaded_file($file_tmp,'/var/www/html/project/assets/images/'.$file_name);
					//base_url().'assets/images/'.$file_name
				if($this->Users->setImagePath(array($this->session->userdata('logged_in')['user_id'],$file_name)))
				{	
					echo "Success";
				}
				else
					echo "Unable to set Image Path";
			}else{
				print_r($errors);
			}
		}
		else
		{
			$this->load->view('templates/header');
			$this->load->view('upload_image');
			$this->load->view('templates/footer');
		}
	}

	
}

/* End of file Upload.php */
/* Location: ./application/controllers/Upload.php */
?>