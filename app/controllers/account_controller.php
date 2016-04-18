<?php
class AccountController extends BaseController {

	public static function login() {
		View::make('realLogin.html');
	}

	public static function handleLogin() {
		$params = $_POST;

		$account = Account::authenticate($params['nickname'], $params['password']);

		if(!$account) {
			View::make('realLogin.html', array('error' => 'Väärä käyttäjätunnus tai salasana'));
		}else{
			$_SESSION['account'] = $account->id;
			Redirect::to('/groups/1'); 
		}
	}
}