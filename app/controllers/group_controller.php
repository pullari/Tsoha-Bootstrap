<?php

class GroupController extends BaseController{

	public static function all(){
		$groups = Ryhma::all();
		View::make('ryhma/groupIndex.html', array('groups' => $groups));
	}

	public static function edit($id){

		$accountgroups = AccountGroup::findByGroup($id); //haetaan groupin accountit

		$accos = array(); //alustetaan accounteille taulukko

		foreach ($accountgroups as $accountg) {
			$accos[] = Account::find($accountg->accoid); //haetaan id:n pohjalta groupin accountit
		}

		View::make('ryhma/groupEdit.html', array('accounts' => $accos));
	}
}