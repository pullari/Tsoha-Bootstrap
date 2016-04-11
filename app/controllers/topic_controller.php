<?php

class TopicController extends BaseController{

	public static function index(){

		$messages = Message::all();
		View::make('topic/index.html', array('messages' => $messages));

	}

	public static function show($id){

		$messages = Message::findAllFromTopic($id);
		View::make('topic/index.html', array('messages' => $messages));
	}

	public static function store($id){

		$params = $_POST;

		$message = new Message(array(
			'topicid' => $id,
			'content' => $params['content'],
			'accoid' => 1   //accoid on vielä kovakoodattu koska sisäänkirjautumista ei ole tehty
		));

		$message->save();
		Redirect::to('/topic/' . $message->topicid, array('message' => 'postattu'));
	}
}