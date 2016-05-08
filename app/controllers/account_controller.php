<?php
class AccountController extends BaseController {

	public static function login() {
		View::make('account/realLogin.html');
	}

	public static function showReg(){
		View::make('account/register.html');
	}

	public static function showEdit() {

		$accounts = account::all();
		View::make('account/edit.html', array('accounts' => $accounts));
	}

	public static function handleLogin() {
		$params = $_POST;

		$account = Account::authenticate($params['nickname'], $params['password']);

		if(!$account) {
			View::make('account/realLogin.html', array('error' => 'Väärä käyttäjätunnus tai salasana'));
		}else{
			$_SESSION['account'] = $account->id;
			Redirect::to('/groups'); 
		}
	}

	public static function logout() {

		$_SESSION['account'] = null;
		Redirect::to('/login', array('message'=>'Kirjauduttu ulos!'));
	}

	public static function store() {

		$params = $_POST;

		$acco = new Account(array(
			'username' => $params['nickname'],
			'password' => $params['password']
		));

		$acco->save();
		Redirect::to('/login', array('message' => 'Käyttäjä lisätty'));
	}

	public static function removeAccount($id) {

		$acco = new Account(array(
			'id' => $id
		));

		$acco->destroy();
		Redirect::to('/accounts', array('message' => 'Käyttäjä poistettu'));
	}

	public static function removeAccounts() {

		$params = $_POST;
		$remove = array();

		if(isset($params['chkbox'])){
			foreach ($params['chkbox'] as $chosen) {  //luodaan kaikki accountGroupit jotka sitten poistetaan
				$remove[] = new Account(array(
					'id' => $chosen['id'],
					'username' => $chosen['username'],
					'password' => $chosen['password'],
					'ismod' => $chosen['ismod']
				));
			}

			Kint::dump($remove);

			foreach ($remove as $acc) {
				$acc->destroy();
			}

			Redirect::to('/accounts', array('message' => 'Käyttäjät poistettu onnistuneesti')); 
		}else{
			Redirect::to('/accounts', array('error' => 'Valitse poistettavat')); 
		}
	}
}