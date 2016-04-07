<?php
  //require 'app/models/message.php';
  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('home.html');
    }

    public static function login(){
      View::make('suunnitelmat/login.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
     // View::make('helloworld.html');
      $messages = Message::all();
      $message = Message::find(1);
      $messages = Message::findAllFromTopic(1);

      Kint::dump($messages);
      Kint::dump($message);
    }

    public static function groups(){
      View::make('suunnitelmat/groups.html');
    }

    public static function topic(){
      View::make('suunnitelmat/topic.html');
    }

    public static function gedit(){
      View::make('suunnitelmat/groupedit.html');
    }
  }
