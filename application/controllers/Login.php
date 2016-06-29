<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$this->load->helper(array('form'));


		$this->load->view('templates/header');
		$this->load->view('login_view');
		$this->load->view('templates/footer');
	}

	function test()//to be removed
	{
		$this->load->model('Answers');
		$this->load->model('Questions');
		$this->load->model('Users');
		//print_r($this->Answers->get_by_key(array(1,2),1,4,'answer_time','a_id'));
		print_r($this->Questions->get_by_key(array(2),4,0,'creation_time','q_id'));

	}

}

?>
