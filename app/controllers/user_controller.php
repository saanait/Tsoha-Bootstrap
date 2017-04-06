<?php

class UserController extends BaseController{
  public static function login(){
      View::make('user/login.html');
  }
  public static function handle_login(){
    $params = $_POST;

    $katselija = Katselija::authenticate($params['username'], $params['password']);

    if(!$katselija){
      View::make('user/login.html', array('error' => 'Virheellinen käyttäjätunnus tai salasana!', 'username' => $params['username']));
    }else{
      $_SESSION['katselija'] = $katselija->id;

      Redirect::to('/etusivu', array('message' => 'Tervetuloa takaisin ' . $katselija->username . '!'));
    }
  }
}

