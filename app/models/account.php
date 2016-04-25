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

	public static function findWithName($username) {

		$query = DB::connection()->prepare('SELECT * FROM Account WHERE username = :username LIMIT 1');
		$query->execute(array('username'=>$username));

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

	public function save(){

		$query = DB::connection()->prepare('INSERT INTO Account(username, password) VALUES (:username, :password) RETURNING id, isMod');
		$query->execute(array('username' => $this->username, 'password' => $this->password));
		$row = $query->fetch();

		$this->id = $row['id'];
		$this->isMod = $row['ismod'];
	}

	public static function validateAccess($id) {

		$accountID = $_SESSION['account'];
		$account = Account::find($accountID);
		$accountGroups = AccountGroup::findByGroup($id);

		if($account->ismod == true){
			return true;
		}

		$isPresent = false;

		foreach ($accountGroups as $AG) {
			if($AG->accoid == $account->id){
				$isPresent = true;
			}
		}
		return $isPresent;
	}
}