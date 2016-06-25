<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class VerifyLogin extends CI_Controller 
{

   function __construct()
   {
     parent::__construct();
   $this->load->model('users','',TRUE);//args
}

function index()
{
       //This method will have the credentials validation
 $this->load->library('form_validation');

 $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|xss_clean');
 $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
 if($this->form_validation->run() == FALSE)
 {
             //Field validation failed.  User redirected to login page
   $this->load->view('login_view');
}
else
{
             //Go to private area
   redirect('home', 'refresh');
}

}

function check_database($password)
{
       //Field validation succeeded.  Validate against database
 $email = $this->input->post('email');

       //query the database
 $result = $this->users->login($email, $password);

 if($result)
 {
   $sess_array = array();
   foreach($result as $row)
   {
     $sess_array = array(
       'user_id' => $row->user_id,
       'email' => $row->email
       );
     $this->session->set_userdata('logged_in', $sess_array);
 }
 return TRUE;
}
else
{
   $this->form_validation->set_message('check_database', 'Invalid email or password');
   return FALSE;
}
}
}
?>
