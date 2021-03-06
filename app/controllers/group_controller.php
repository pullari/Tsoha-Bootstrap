<?php

class GroupController extends BaseController{

	public static function stand(){

		$account = GroupController::get_user_logged_in();

		if($account->ismod){
			$groups = Ryhma::all(); //group dropdown-valikolle
		}else{
			$groups = Ryhma::findAllAccounts($account->id);
		}

		View::make('ryhma/groupIndex.html', array('groups'=>$groups, 'account'=>$account));
	}

	public static function find($id){

		$account = GroupController::get_user_logged_in();

		if($account->ismod){
			$groups = Ryhma::all(); //group dropdown-valikolle
		}else{
			$groups = Ryhma::findAllAccounts($account->id);
		}

		$show = Ryhma::find($id);
		$topics = Topic::findByGroup($id); //haetaan topicit jonka jälkeen haetaan niistä 6 ensimmäistä viestiä ja laitetaan ne omaan taulukkoon joka passataan viewille, jotta voidaan näyttää viestit

		$messages[] = array();

		foreach ($topics as $topic) {
			
			$topicsMessages = Message::findAllFromTopic($topic->id);
			$messages[$topic->id] = $topicsMessages;  //tallennetaan assosiaatiolistaan tunnisteena topicid

			foreach ($topicsMessages as $mes) {
				$mes->timeForm(); //formatoidaan vielä messagen aikaleima mukavempaan muotoon
			}
		}

		if($show){
			GroupController::validateAccountAccess($show->id);
		}

		View::make('ryhma/groupIndex.html', array('groups' => $groups, 'show' => $show, 'topics' => $topics, 'messages' => $messages, 'account' => $account));

	}

	public static function edit($id){

		$accountgroups = AccountGroup::findByGroup($id); //haetaan groupin accountit

		$accos = array(); //alustetaan accounteille taulukko

		foreach ($accountgroups as $accountg) {
			$accos[] = Account::find($accountg->accoid); //haetaan id:n pohjalta groupin accountit
		}

		GroupController::validateAccountAccess($id);
		View::make('ryhma/groupEdit.html', array('accounts' => $accos, 'groupid'=>$id));
	}

	public static function store($id) {

		$params = $_POST;

		$topic = new Topic(array(  //tehdään uusi tyhjä topic ja alempana lisätään alkuviesti
			'groupid' => $id
		));

		GroupController::validateAccountAccess($id);

		$dummyMessage = new Message(array(        //koska messagen luonti luottaa siihen että topic on jo luotu
			'content' => $params['topicContent']  //emmekä halua tyhjjiä topiceja luomme viestistä tyngän jossa
		));										  //on vain virheen tarkistuksen kannalta olennainen osa
		$errors = $dummyMessage->errors();
		if(count($errors) != 0){
			Redirect::to('/groups/' . $topic->groupid, array('errors' => $errors));
		}else{

			$topic->save();
			$poster = GroupController::get_user_logged_in();

			$message =  new Message(array(

				'topicid' => $topic->id,
				'content' => $params['topicContent'],
				'accoid' => $poster->id  
			));

			$message->save();
			Redirect::to('/groups/' . $topic->groupid, array('message' => 'topic avattu'));
		}
	}

	public static function addNew() {

		$params = $_POST;

		$group = new Ryhma(array(
			'name' => $params['groupName']
		));

		$group->save();
		Redirect::to('/groups', array('message'=>'Uusi ryhmä lisätty'));
	}

	public static function removeGroup($id) {

		$group = new Ryhma(array(
			'id' => $id
		));

		$group::destroy($id);
		Redirect::to('/groups', array('message'=>'Ryhmä poistettu onnistuneesti'));
	}

	public static function removeTopic($id) {

		$topic = new Topic(array(
			'id' => $id
		));

		GroupController::validateAccountAccess($id);

		$groupid = $topic->destroy($id);
		Redirect::to('/groups/' . $groupid, array('message' => 'topic poistettu'));
	}
}