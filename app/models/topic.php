<?php

class Topic extends BaseModel{

	public $id, $groupid;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	public function save(){

		$query = DB::connection()->prepare('INSERT INTO Topic (groupID) VALUES (:groupid) RETURNING id');
		$query->execute(array('groupid' => $this->groupid));

		$row = $query->fetch();
		$this->id = $row['id'];
	}

	public static function all(){

		$query = DB::connection()->prepare('SELECT * FROM Topic');
		$query->execute();

		$rows = $query->fetchAll();
		$topics = array();

		foreach($rows as $row){

			$topics = new Topic(array(
				'id' => $row['id'],
				'groupid' => $row['groupid']
			));
		}
		return $topics;
	}

	public static function find($id){

		$query = DB::connection()->prepare('SELECT * FROM Topic WHERE Topic.id = :id');
		$query->execute(array('id' => $id));

		$row = $query->fetch();

		if($row){

			$topic = new Topic(array(
				'id' => $row['id'],
				'groupid' => $row['groupid']
			));

			return $topic;
		}
		return null;
	}

	public static function findByGroup($id){

		$query = DB::connection()->prepare('SELECT * FROM Topic WHERE groupid = :id');
		$query->execute(array('id'=>$id));

		$rows = $query->fetchAll();

		$topics = array();

		foreach ($rows as $row) {		
			$topics[] = new Topic(array(
				'id' => $row['id'],
				'groupid' => $row['groupid'],
			));
		}
		return $topics;
	}
}