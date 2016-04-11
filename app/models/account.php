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

}