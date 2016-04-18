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
      $message = new Message(array(
        'id' => '15',
        'topicid' => '1',
        'accoid' => '1',
        'posttime' => 'tänää',
        'content' => 'asd'
      ));

      $errors = $message->errors();
      Kint::dump($errors);
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
