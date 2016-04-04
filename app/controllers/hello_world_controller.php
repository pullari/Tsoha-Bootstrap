<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('home.html');
    }

    public static function login(){
      View::make('login.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('helloworld.html');
    }

    public static function groups(){
      View::make('groups.html');
    }

    public static function topic(){
      View::make('topic.html');
    }

    public static function gedit(){
      View::make('groupedit.html');
    }
  }
