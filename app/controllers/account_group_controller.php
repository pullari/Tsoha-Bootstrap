<?php
class AccountGroupController extends BaseController{

	public static function store() {

		$params = $_POST;

		$account = Account::findWithName($params['username']);

		if($account){
			$accogroup = new AccountGroup(array(
				'groupid' => $params['groupid'],
				'accoid' => $account->id
			));

			$accogroup->save();
			Redirect::to('/groups/' . $accogroup->groupid . '/edit', array('message' => 'Käyttäjä lisätty ryhmään'));
		}
		Redirect::to('/groups/' . $params['groupid'] . '/edit', array('error' => 'Käyttäjää ei löytynyt'));
	}

	public static function removeSelect() {

		$params = $_POST;
		$remove = array();

		if(isset($params['chkbox'])){
			foreach ($params['chkbox'] as $chosen) {  //luodaan kaikki accountGroupit jotka sitten poistetaan
				$remove[] = new AccountGroup(array(
					'accoid' => (int)$chosen,
					'groupid' => (int)$params['groupid']
				));
			}
			
			foreach ($remove as $fromGroup) {
				$fromGroup->destroy();
			}

			Redirect::to('/groups/' . (int)$params['groupid'] . '/edit', array('message' => 'Käyttäjät poistettu onnistuneesti')); 
		}else{
			Redirect::to('/groups/' . (int)$params['groupid'] . '/edit', array('error' => 'Valitse poistettavat')); 
		}
	}
}