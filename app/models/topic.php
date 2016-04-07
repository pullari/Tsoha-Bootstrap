<?php

public $id, $groupid;

class Topic extends BaseModel{

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function all(){

		$query = DB::connection()->prepare('SELECT * FROM Topic');
		$query->execute();

		$rows = $query->fetchAll();
		$topics = array();

		foreach($rows as $row){

			$topics = new Topic(array(
				'id' => $row['id'];
				'groupid' => $row['groupid'];
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
				'id' => $row['id'];
				'groupid' => $row['groupid'];
			));
		}
	}
}