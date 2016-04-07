<?php

class Message extends BaseModel{

	public $id, $posttime, $topicid, $accoid, $content;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function all(){

		$query = DB::connection()->prepare('SELECT * FROM Message');

		$query->execute();

		$rows = $query->fetchAll();
		$messages = array();

		foreach ($rows as $row) {
			
			$messages[] = new Message(array(
				'id' => $row['id'],
				'posttime' => $row['posttime'],
				'topicid' => $row['topicid'],
				'accoid' => $row['accoid'],
				'content' => $row['content']
			));
		}
		return $messages;
	}

	public static function find($id){

		$query = DB::connection()->prepare('SELECT * FROM Message WHERE id = :id LIMIT 1');

		$query->execute(array('id' => $id));
		$row = $query->fetch();

		if($row){

			$message = new Message(array(
				'id' => $row['id'],
				'posttime' => $row['posttime'],
				'topicid' => $row['topicid'],
				'accoid' => $row['accoid'],
				'content' => $row['content']
			));
			return $message;
		}
		return null;
	}

	public static function findAllFromTopic($id){

		$query = DB::connection()->prepare('SELECT * FROM Message WHERE topicID = :id');

		$query->execute(array('id' => $id));
		$rows = $query->fetchAll();

		$messages = array();

		foreach ($rows as $row) {
			
			$messages[] = new Message(array(
				'id' => $row['id'],
				'posttime' => $row['posttime'],
				'topicid' => $row['topicid'],
				'accoid' => $row['accoid'],
				'content' => $row['content']
			));
		}
		return $messages;
	}
}