<?php

  class BaseController{
      
    public static function check_logged_in(){
      // Toteuta kirjautumisen tarkistus tähän.
      // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
      if(!isset($_SESSION['katselija'])){
        Redirect::to('/login', array('message' => 'Kirjaudu ensin sisään!'));
      }
    }  

    public static function get_user_logged_in(){
        
      // Toteuta kirjautuneen käyttäjän haku tähän

      // Katsotaan onko user-avain sessiossa
      if(isset($_SESSION['katselija'])){
        $user_id = $_SESSION['katselija'];
      // Pyydetään User-mallilta käyttäjä session mukaisella id:llä
        $user = Katselija::find($user_id);        

        return $user;
      }

    // Käyttäjä ei ole kirjautunut sisään
      return null;
    }
  // ...

    

    

  }
