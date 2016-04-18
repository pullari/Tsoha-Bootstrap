<?php

class Account extends BaseModel{

	public $id, $username, $password, $ismod;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function find($id){

		$query = DB::connection()->prepare('SELECT * FROM Account WHERE id = :id LIMIT 1');
		$query->execute(array('id'=>$id));

		$row = $query->fetch();

		if($row){

			$account = new Account(array(

				'id' => $row['id'],
				'username' => $row['username'],
				'password' => $row['password'],
				'ismod' => $row['ismod']
			));

			return $account;
		}
		return null;
	}

	public static function authenticate($nick, $pass) {

		$query = DB::connection()->prepare('SELECT * FROM Account WHERE username = :nick AND password = :pass LIMIT 1');
		$query->execute(array('nick' => $nick, 'pass' => $pass));

		$row = $query->fetch();

		if($row){

			$account = new Account(array(

				'id' => $row['id'],
				'username' => $row['username'],
				'password' => $row['password'],
				'ismod' => $row['ismod']
			));

			return $account;
		}
		return null;
	}
}