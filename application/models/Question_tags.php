<?php 
	/**
	* 
	*/
	class Question_tags extends MY_Model
	{
		
		function __construct()
		{	
			parent::__construct('tags');
		}

		function insert($q_id, $tag_id)
		{
			try
			{
				// $tags - array of tag ids
				$sql = $this->conn_id->prepare("INSERT INTO question_tags(tag_id, q_id) VALUES (?, ?)");
				$sql->execute(array($tag_id, $q_id));
				return 1;
			}
			catch (PDOException $e)
			{
			}
		}

		function get_tag_id($q_id)
		{
			try
			{
				$query = "select tag_id from question_tags where question_tags.q_id = '".$q_id."'";

				$sql = $this->conn_id->query($query);

				if ( $row = $sql->fetchAll())
				{
					return $row;
				}
				else
				{
					// echo "I am here.";
				}
			}
			catch(PDOException $e)
			{
				echo "Something went wrong.";
			}
		}



		function get_questions_by_tag_id($tag_id)
		{
			try
			{
				$query = "select * from questions join question_tags where question_tags.tag_id = '".$tag_id."'and question_tags.q_id = questions.q_id order by questions.creation_time DESC ";

				$sql = $this->conn_id->query($query);

				if ( $row = $sql->fetchAll())
				{
					return $row;
				}
				else
				{
					// echo "I am here.";
				}
			}
			catch(PDOException $e)
			{
				echo "Something went wrong.";
			}
		}

		/*
		*	get_qid_by_tagid_userid
		*   @args: $user_id -> single user_id
		*          $tag_id -> array of tagids
		*   @returns  
		*/
		function get_myinterest($user_id)
		{
			try
			{
				if(!is_numeric($user_id) ){
					throw new Exception("Invalid arguments");
				}

				$query = "select DISTINCT q_id from follows join question_tags on follows.tag_id = question_tags.tag_id where follows.user_id = '".$user_id."'";

				//echo $query;

				$sql = $this->conn_id->query($query);

				if ( $row = $sql->fetchAll(PDO::FETCH_NUM))
				{
					return $row;
				}
				else
				{
					throw new Exception("Error in sql query");
				}
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}
	}
	?>