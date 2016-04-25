<?php
class AccountController extends BaseController {

	public static function login() {
		View::make('account/realLogin.html');
	}

	public static function showReg(){
		View::make('account/register.html');
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
}