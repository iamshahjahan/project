<?php 
class Profile extends CI_Controller 
{

   function __construct()
   {
        parent::__construct();
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
        $this->load->model('Users','',TRUE);//args
   }

    function index()
    {
          $sess_data = $this->session->userdata('logged_in');

          if($sess_data)
          {
            $data = $this->Users->get($sess_data['user_id']);
            $this->load->view('myprofile_view',$data[0]);
            echo 'logged in';
        }
        else
        {
            //show public profile
         echo 'not logged in';
         $this->load->view('kprofile_view',$data[0]);

        }
    }

    function edit()
    {
      $sess_data = $this->session->userdata('logged_in');
      if($sess_data){
        $data = $this->Users->get($sess_data['user_id'])[0];

        if (isset($_POST['submit']))
        {
            // setting the rules for form_validation using codeigniter

          $this->form_validation->set_rules('name', 'Name', 'required|min_length[1]');

          $this->form_validation->set_rules('mobileno', 'Mobile ', 'required|exact_length[10]');

          $this->form_validation->set_rules('about', 'Name', 'trim');


            // running form_validation methods

          if ($this->form_validation->run() == TRUE)
          {

            $name = $_POST['name'];
            $mob = $_POST['mobileno'];
            $about = $_POST['about'];

            if($this->Users->save(array($name,$mob,$about,$data['user_id'])))
            {
              echo 'Changes saved';
          }
          else
          {
              echo "Error saving changes";
          }
      }
      else
      {
            //redirect("profile",'refresh');    
        $this->load->view('myprofile_view',$data);
    }

    }
    else
    {
      echo "Unable to save";
    }
    }
    else
    {
        //show public profile
     echo 'not logged in';
     $this->load->view('profile_view'); 
    }
    }

    function changepass()
    {
      $sess_data = $this->session->userdata('logged_in');
      if($sess_data){
        $data = $this->Users->get($sess_data['user_id'])[0];

        if (isset($_POST['submit']))
        {
          $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
          if ($this->form_validation->run() == TRUE)
          {
            $result = $this->Users->login($data['email'], $_POST['password']);
            if($result)
            {
               $this->load->view('confirmpass',array('email'=>$data['email']));
           }
           else
           {
            echo "unable to verify";
        }
    }
    else
    {
            $this->load->view('changepass_view',array('email'=>$data['email']));//check
        }
        }//first time load this view
        else
        { 
          $this->load->view('changepass_view',array('email'=>$data['email']));
      }
    }
    else
    {
        //show public profile
     echo 'not logged in';
     $this->load->view('login_view'); 
    }
    }

}
?>
