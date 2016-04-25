<?php

class TopicController extends BaseController{

	public static function index(){

		$messages = Message::all();
		View::make('topic/index.html', array('messages' => $messages));

	}

	public static function show($id){

		$account = TopicController::get_user_logged_in();
		$messages = Message::findAllFromTopic($id);
		View::make('topic/index.html', array('messages' => $messages, 'account' => $account));
	}

	public static function store($id) {

		$params = $_POST;
		$acco = TopicController::get_user_logged_in();

		$message = new Message(array(
			'topicid' => $id,
			'content' => $params['content'],
			'accoid' => $acco->id   //accoid on vielä kovakoodattu koska sisäänkirjautumista ei ole tehty
		));

		$errors = $message->errors();

		if(count($errors) == 0){

			$message->save();
			Redirect::to('/topic/' . $message->topicid, array('message' => 'postattu'));
		}else{
			Redirect::to('/topic/' . $message->topicid, array('errors' => $errors));
		}
	}

	public static function updateMessage($id) {

		$params = $_POST;

		$message = new Message(array(
			'id' => $id,
			'topicid' => $params['topicid'],
			'content' => $params['content']
		));

		$errors = $message->errors();

		if(count($errors) == 0){
			$message->update();
			Redirect::to('/topic/' . $message->topicid, array('message' => 'päivitetty'));
		}else{
			Redirect::to('/topic/' . $message->topicid, array('errors' => $errors));
		}

	}

	public static function removeMessage($id) {

		$message = new Message(array(
			'id' => $id
		));
		$topicid = $message->destroy($id);
		Redirect::to('/topic/' . $topicid, array('message' => 'viesti poistettu'));
	}
}