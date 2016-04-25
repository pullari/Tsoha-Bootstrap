<?php

class Ryhma extends BaseModel{

	public $id, $name;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function all(){

		$query = DB::connection()->prepare('SELECT * FROM Ryhma');
		$query->execute();

		$rows = $query->fetchAll();
		$ryhmat = array();

		foreach ($rows as $row) {
			
			$ryhmat[] = new Ryhma(array(

				'id' => $row['id'],
				'name' => $row['name']
			));
		}
		return $ryhmat;
	}

	public static function findAllAccounts($id) {

		$query = DB::connection()->prepare('SELECT id, name FROM Ryhma, AccountGroup WHERE id = groupid AND accoid = :id');
		$query->execute(array('id' => $id));

		$rows = $query->fetchAll();
		$ryhmat = array();

		foreach ($rows as $row) {
			
			$ryhmat[] = new Ryhma(array(

				'id' => $row['id'],
				'name' => $row['name']
			));
		}
		return $ryhmat;
	}

	public static function find($id){

		$query = DB::connection()->prepare('SELECT * FROM Ryhma WHERE id = :id LIMIT 1');
		$query->execute(array('id' => $id));

		$row = $query->fetch();

		if($row){

			$group = new Ryhma(array(

				'id' => $row['id'],
				'name' => $row['name']
			));
			return $group;
		}
		return null;
	}

	public function save() {

		$query = DB::connection()->prepare('INSERT INTO Ryhma(name) VALUES (:name) RETURNING id');
		$query->execute(array('name'=>$this->name));

		$row = $query->fetch();
		$this->id = $row['id'];
	}
}