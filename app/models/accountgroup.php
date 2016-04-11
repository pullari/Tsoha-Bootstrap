<?php

class AccountGroup extends BaseModel {

	public $accoid, $groupid;

	public function __construct($attributes){
		parent::__construct($attributes);
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

}