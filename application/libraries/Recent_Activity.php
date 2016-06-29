<?php
/* 
    * show user specific recent activities if 'loggedin' session set,or _arg$1 else global recent
    */
/**
* 
*/
class Recent_Activity extends CI_Model{
	
	function __construct(){
		parent::__construct();
		$this->load->model('Questions');
		$this->load->model('Answers');		
	}
    function recent_act($u_id=0,$limit=7)//limit 7 Ques and 7 Ans max 
    {
    	// $this->load->model('Questions');
    	// $this->load->model('Answers');
        // $sess_data = $this->session->userdata('logged_in');
        // $u_id = "";
        // if($sess_data || $u_id){//show user specific recent activiteies
        //     if($sess_data){
        //         $u_id = $sess_data['user_id'];
        //     }
        //     else{
        //         $u_id = $_GET['user_id'];
        //     }
            //$u_id = $sess_data['user_id'];
    	$ques = $this->Questions->get_by_key(0,$limit,$u_id,'creation_time','q_id');
        //count anss
    	$ans = $this->Answers->get_by_key(0,$limit,$u_id,'answer_time','a_id');



            //print_r($ques);
    	if($ans!=0)
    	{
    		$qid_of_ans = array_column($ans, 'q_id');
            //print_r($qid_of_ans);
            //echo '</br>';

    		$ansdata = array(array());
    		$temp = array(array());

    		$x=0;
    		foreach ($qid_of_ans as $qid) {
    			$temp[$x] = $this->Questions->get($qid,$limit)[0];
    			$temp[$x]['q_u_id']= $temp[$x]['user_id'];
    			$ansdata[$x]=array_merge($temp[$x],$ans[$x]);
    			$x = $x + 1;
    		}

    		$final_data=$ansdata;//	
    	}
    	

            //print_r($temp);

            //echo '</br>';

            //print_r($ansdata);
            //echo '</br>';


            //echo '</br>';
            //print_r($ques);
            //echo '</br>';
            //echo '</br>';
            //print_r($ans);
            //print_r(array_merge($ansdata,$ques));
    	if($ques!=0 && $ans!=0){
    	$final_data=array_merge($ansdata,$ques);
    }
    else if($ques!=0)
    {
    	$final_data=$ques;
    }

    if(count($final_data)>=1){//isset
    	// function comp($a, $b) {
    	// 	$ts1 = strtotime($a['creation_time']);
    	// 	$ts2 = strtotime($b['creation_time']);
    	// 	return $ts2 - $ts1;
    	// }
    	usort($final_data, function($a, $b) {
    		$ts1 = strtotime($a['creation_time']);
    		$ts2 = strtotime($b['creation_time']);
    		return $ts2 - $ts1;
    	});//'comp');
            // foreach ($final_data as $key => $row) {
            //     $dates[$key]  = $row['creation_time'];
            // }
            // print_r($dates);
            // $disp=array_multisort($dates, SORT_DESC, $final_data);
            //echo '</br>';
            //echo '</br>';
            //return $final_data;

    	$this->load->view('recent_act',array('finaldata'=>$final_data));
    }
       //  }
       //  else
       //  {
       //  //show public profile
       //     echo 'not logged in';
       //     $this->load->view('pub_profile_view'); 
       // }
    }
}
?>