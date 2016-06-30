<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->helper('url');
   $this->load->model('Users');   
   $this->load->library('Recent_Activity');
 }
 
 function index()
 {
 	//print_r($this->Users->get());//shahjehan's
   if($this->session->userdata('logged_in'))set_userdata
   {
     $session_data = $this->session->userdata('logged_in');
     //$data['email'] = $session_data['email'];
     $this->load->view('templates/header');//send sess data
     $this->load->view('home_view', $session_data);//send sess data
     //echo "Recent Question and Answers";
     $this->recent_activity->recent_act();
     var_dump($this->session->userdata('logged_in'));
     $this->load->view('templates/footer');//send sess data
   }
   else
   {
     redirect('login', 'refresh');
   }
 }
 
 function logout()
 {
   $this->session->unset_userdata('logged_in');
   session_destroy();
   redirect('home', 'refresh');
 }
 
}
?>
