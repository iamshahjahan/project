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
	function recent_act($u_id=0,$limit=0,$offset=0) 
	{
		$ques = $this->Questions->get_by_key(0,$limit,$offset,$u_id,'creation_time','q_id');

			// var_dump($ques);
			// it means we have some questions.
		$ans = $this->Answers->get_by_key(0,$limit,$offset,$u_id,'answer_time','a_id');
		$final_data = array();


		


		if($ques!=0)
		{
				// no of answers to the above question.
			$cnt = $this->Answers->count_by_qid(array_column($ques, 'q_id'));	


			$temp = array();
						foreach ($cnt as $c) {//change key to q_id
							$temp[$c['q_id']] = $c;
						}
						$cnt = $temp;

						$x=0;
						foreach ($ques as $q) {
							if(isset($cnt[$q['q_id']])){
								$ques[$x]['ans_count'] = $cnt[$q['q_id']]['count'];
							}
							else{
								$ques[$x]['ans_count'] = 0;
							}
							$x = $x + 1;
						} 
					}

					// user has answered some questions.
					if($ans!=0)
					{
						$qid_of_ans = array_column($ans, 'q_id');

						$ansdata = array(array());
						$temp = array(array());

						$x=0;
						foreach ($qid_of_ans as $qid) {
							$temp[$x] = $this->Questions->get($qid,$limit)[0];
							$temp[$x]['q_u_id']= $temp[$x]['user_id'];
							$ct=$this->Answers->count_by_qid(array($qid));
							if(count($ct)){
								$temp[$x]['ans_count']=$ct[0]['count'];
							}
							else
							{
								$temp[$x]['ans_count'] = 0;
							}
							$ansdata[$x]=array_merge($temp[$x],$ans[$x]);
							$x = $x + 1;
						}

						$final_data=$ansdata;
					}
					if($ques!=0 && $ans!=0){
						$final_data=array_merge($ansdata,$ques);
					}
					else if($ques!=0)
					{
						$final_data=$ques;
					}

					if($ques!=0 || $ans!=0)
					{
						$x=0;$y=0;
						$u_temp=array();
						foreach ($final_data as $row) {
							$u_temp[$x++]=$row['user_id'];
							if(isset($row['a_id'])){
								$u_temp[$x++]=$row['q_u_id'];
							}
						}
						if(count($u_temp))
						{
							$u_temp = array_unique($u_temp);
								$u_data=$this->Users->get_by_key('user_id',0,0,0,'-1',$u_temp);//u_data has uid-names
								$temp = array();
						foreach ($u_data as $r) {//change key to user_id
							$temp[$r['user_id']] = $r['name'];
						}
						$u_data = $temp;//$u_data has user_id-name mapping 
						for ($x = 0; $x < count($final_data) ; $x++) {
							// this guy has answered the question
							$final_data[$x]['aauthor'] = $u_data[$final_data[$x]['user_id']];
							// this guy has asked the question
							if(isset($final_data[$x]['q_u_id'])){
								$final_data[$x]['qauthor'] = $u_data[$final_data[$x]['q_u_id']];
							}
						}

					}
				}

				if(count($final_data)>=1){
					usort($final_data, function($a, $b) {
						$ts1 = strtotime($a['creation_time']);
						$ts2 = strtotime($b['creation_time']);
						return $ts2 - $ts1;
					});

					// let us load the view with the data.
					$this->load->view(
						'recent_act',array(
							'finaldata'=>$final_data
							));

				}
			}
		}
		?>