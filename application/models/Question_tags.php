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
				$sql = $this->conn_id->prepare("INSERT INTO question_tags(tag_id, q_id) VALUES (?, ?) desc");
				$sql->execute(array($tag_id, $q_id));
				return 1;
			}
			catch (PDOException $e)
			{
				// Todo
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
	}
	?>