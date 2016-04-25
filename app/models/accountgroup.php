<?php

class AccountGroup extends BaseModel {

	public $accoid, $groupid;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function findExact($groupid, $accoid) {

		$query = DB::connection()->prepare('SELECT * FROM AccountGroup WHERE groupid = :groupid AND accoid = :accoid');
		$query->execute(array('groupid'=>$groupid, 'accoid'=>$accoid));

		$rows = $query->fetchAll();

		$accountgroups = array();

		foreach ($rows as $row) {		
			$accountgroups[] = new AccountGroup(array(
				'accoid' => $row['accoid'],
				'groupid' => $row['groupid'],
			));
		}
		return $accountgroups;
	}

	public static function findByGroup($id){

		$query = DB::connection()->prepare('SELECT * FROM AccountGroup WHERE groupid = :id');
		$query->execute(array('id'=>$id));

		$rows = $query->fetchAll();

		$accountgroups = array();

		foreach ($rows as $row) {		
			$accountgroups[] = new AccountGroup(array(
				'accoid' => $row['accoid'],
				'groupid' => $row['groupid'],
			));
		}
		return $accountgroups;
	}

	public function save() {

		$query = DB::connection()->prepare('INSERT INTO AccountGroup(groupid, accoid) 
			VALUES (:groupid, :accoid)');
		$query->execute(array('groupid' => $this->groupid, 'accoid' => $this->accoid));
		$row = $query->fetch();
	}

	public function destroy() {

		$query = DB::connection()->prepare('DELETE FROM AccountGroup WHERE groupid = :groupid AND accoid = :accoid');
		$query->execute(array('groupid' => $this->groupid, 'accoid' => $this->accoid));
		$row = $query->fetch();
	}
}