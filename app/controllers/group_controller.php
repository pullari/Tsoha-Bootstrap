<?php

class GroupController extends BaseController{

	public static function all(){
		$groups = Ryhma::all();
		View::make('ryhma/groupIndex.html', array('groups' => $groups));
	}

	public static function find($id){

		$groups = Ryhma::all(); //group dropdown-valikolle
		$show = Ryhma::find($id);
		$topics = Topic::findByGroup($id); //haetaan topicit jonka jälkeen haetaan niistä 6 ensimmäistä viestiä ja laitetaan ne omaan taulukkoon joka passataan viewille, jotta voidaan näyttää viestit

		$messages[] = array();

		foreach ($topics as $topic) {
			
			$topicsMessages = Message::findAllFromTopic($topic->id);
			$messages[$topic->id] = $topicsMessages;  //tallennetaan assosiaatiolistaan tunnisteena topicid
		}

		View::make('ryhma/groupIndex.html', array('groups' => $groups, 'show' => $show, 'topics' => $topics, 'messages' => $messages));

	}

	public static function edit($id){

		$accountgroups = AccountGroup::findByGroup($id); //haetaan groupin accountit

		$accos = array(); //alustetaan accounteille taulukko

		foreach ($accountgroups as $accountg) {
			$accos[] = Account::find($accountg->accoid); //haetaan id:n pohjalta groupin accountit
		}

		View::make('ryhma/groupEdit.html', array('accounts' => $accos));
	}

	public static function store($id) {

		$params = $_POST;

		$topic = new Topic(array(  //tehdään uusi tyhjä topic ja alempana lisätään alkuviesti
			'groupid' => $id
		));


		$dummyMessage = new Message(array(        //koska messagen luonti luottaa siihen että topic on jo luotu
			'content' => $params['topicContent']  //emmekä halua tyhjjiä topiceja luomme viestistä tyngän jossa
		));										  //on vain virheen tarkistuksen kannalta olennainen osa
		$errors = $dummyMessage->errors();
		if(count($errors) != 0){
			Redirect::to('/groups/' . $topic->groupid, array('errors' => $errors));
		}else{

			$topic->save();

			$message =  new Message(array(

				'topicid' => $topic->id,
				'content' => $params['topicContent'],
				'accoid' => 1   //accoid on vielä kovakoodattu koska sisäänkirjautumista ei ole tehty
			));

			$message->save();
			Redirect::to('/groups/' . $topic->groupid, array('message' => 'topic avattu'));
		}
	}

	public static function removeTopic($id) {

		$topic = new Topic(array(
			'id' => $id
		));
		$groupid = $topic->destroy($id);
		Redirect::to('/groups/' . $groupid, array('message' => 'topic poistettu'));
	}
}