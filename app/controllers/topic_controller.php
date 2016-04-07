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
}