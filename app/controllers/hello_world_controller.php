<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  echo 'Tämä on etusivu!';
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
        View::make('helloworld.html');
    }
    
    public static function series_list(){
        View::make('suunnitelmat/series_list.html');
    }

    public static function series_show(){
        View::make('suunnitelmat/series_show.html');
    }
    
    public static function series_edit(){
        View::make('suunnitelmat/series_edit.html');
    }

    public static function login(){
        View::make('suunnitelmat/login.html');
    }
    
    public static function etusivu(){
        View::make('suunnitelmat/etusivu.html');
    }    
  }
