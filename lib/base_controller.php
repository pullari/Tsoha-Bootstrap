<?php

  class BaseController{

    public static function get_user_logged_in(){
      // Toteuta kirjautuneen käyttäjän haku tähän

      if(isset($_SESSION['account'])){

        $accountID = $_SESSION['account'];
        $account = Account::find($accountID);

        return $account;
      }

      return null;
    }

    public static function check_logged_in(){
      // Toteuta kirjautumisen tarkistus tähän.
      // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).

      if(!isset($_SESSION['account'])){
        Redirect::to('/login', array('message'=>'Kirjaudu sisään, päästäksesi sivulle.'));
      }
    }

    public static function check_if_mod() {

      if(isset($_SESSION['account'])){

        $accountID = $_SESSION['account'];
        $account = Account::find($accountID);

        if($account->ismod == false){
          Redirect::to('/groups', array('message'=>'Yrittämäsi operaatio on vain moderaattoreille'));
        }
      }
    }

    public static function validateAccountAccess($id) {

      $isPresent = Account::validateAccess($id);

      if($isPresent == false){
        Redirect::to('/groups', array('message'=>'Ei pääsyä ryhmään'));
      }
    }
  }
