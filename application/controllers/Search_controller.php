<?php

class Search_controller extends  CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('users');
		$this->load->model('tags');
		$this->load->model('answers');
		$this->load->model('questions');
	}

	function index() {
		$this->load->view('templates/header');
		$this->load->view('testview');
		$this->load->view('templates/footer');
	}

	function tagsearch(){
		if(isset($_POST['search'])){

// 			$name= urlencode($_POST['search']);
			$tag_name = $_POST['tag1'];      
//	echo $tag_name;
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, "http://localhost:8983/solr/collection1/select?q=tagname%3A*".$tag_name."*&wt=json&indent=true");
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); //setting content type header
//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

//curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

//The most important is

//curl_setopt($curl, CURLOPT_SSLVERSION, 3);

// Download the given URL, and return output

	$result = curl_exec($curl);




// //curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);//Setting raw post data as xml
// $result = curl_exec($curl);
// curl_close($curl);
	$result=json_decode($result, true);
//print_r($result);
	if($result['response']['numFound']>=1)
	{
	//print_r(array('count'=>$result['response']['numFound'],'docs'=>$result['response']['docs']));
	//$this->load->view('search_view',array('count'=>$result['response']['numFound'],'docs'=>$result['response']['docs'],'query'=>$tag_name));

		$tags=array();
		foreach ($result['response']['docs'] as $res) {
			foreach ($res['tagname'] as $tg ){
				if(strpos( $tg,$tag_name )!==FALSE){
					array_push($tags, $tg);
				}
			}
		}
		$this->load->view('search_view',array('tags'=>$tags));
	}
	else
	{
		echo "No results found";
	}

// //$data = json_decode($result, true);
// $data = array(
// 	"response" => $result['response']['docs']
// 	);

}
else
{
	echo "error in post";
}
}

function quesinsert($qid,$title,$desc,$tags)//array of tags
{

	$data = array(array("id" => $qid,"q_title"=>$title,"q_desc"=>$desc, "tagname" => $tags));                                      
	$data_string = json_encode($data);
//print_r($data_string);
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, "http://localhost:8983/solr/update?commit=true&wt=json&indent=true");
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); //setting content type header
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
//curl_setopt($curl, CURLOPT_POST, TRUE);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

//curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

//The most important is

//curl_setopt($curl, CURLOPT_SSLVERSION, 3);

// Download the given URL, and return output

$result = curl_exec($curl);
if(json_decode($result)->responseHeader->status==0)
{
	echo 'solr update and indexing success';
}
else
{
	echo 'error in solr update and indexing';
}

}

function taginsert($tagid,$tagname)//function not required
{

	$data = array(array("id" => $tagid, "name" => $tagname));                                      
	$data_string = json_encode($data);
//print_r($data_string);
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, "http://localhost:8983/solr/update?commit=true&wt=json&indent=true");
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); //setting content type header
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
	//curl_setopt($curl, CURLOPT_POST, TRUE);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
	//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

	//curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

	//The most important is

	//curl_setopt($curl, CURLOPT_SSLVERSION, 3);

	// Download the given URL, and return output

	$result = curl_exec($curl);
	if(json_decode($result)->responseHeader->status==0)
	{
		return True;
		// echo 'solr update and indexing success';
	}
	else
	{
		return false;
	}
}

function quessearch(){
	if(isset($_POST['search'])){

// 			$name= urlencode($_POST['search']);
		$ques = $_POST['search'];      
//	echo $tag_name;
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, "http://localhost:8983/solr/collection1/select?q=tagname%3A*".$ques."*&wt=json&indent=true");
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); //setting content type header
//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

//curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

//The most important is

//curl_setopt($curl, CURLOPT_SSLVERSION, 3);

// Download the given URL, and return output

			$result = curl_exec($curl);




// //curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);//Setting raw post data as xml
// $result = curl_exec($curl);
// curl_close($curl);
			$result=json_decode($result, true);
// print_r($result);
			$response['success'] = 1;

			echo json_encode($result['response']['docs']);
	// 		if($result['response']['numFound']>=1)
	// 		{
	// //print_r(array('count'=>$result['response']['numFound'],'docs'=>$result['response']['docs']));
	// 			// $this->load->view('search_view2',array('count'=>$result['response']['numFound'],'docs'=>$result['response']['docs']));

	// 			$response['success'] = 1;

	// 		}
	// 		else
	// 		{
	// 			$response['success'] = 0;
	// 			echo json_encode($response);
	// 		}

// //$data = json_decode($result, true);
// $data = array(
// 	"response" => $result['response']['docs']
// 	);

		}
		else
		{
			$response['success'] = 0;
			echo json_encode($response);
		}
	}
}

?>