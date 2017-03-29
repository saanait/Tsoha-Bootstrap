<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  echo 'Tämä on etusivu!';
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
//        View::make('helloworld.html');
        $westworld = Sarja::find(1);
        $sarjat = Sarja::all();
        $katselijat = Katselija::all();
        //Kint-luokan dump-metodi tulostaa muuttujan arvon
        Kint::dump($sarjat);
        Kint::dump($westworld);
        Kint::dump($katselijat);
        
        
    }
    
    public static function sarja_list(){
        $sarjat = Sarja::all();
        View::make('sarja/sarja_list.html', array('sarjat' => $sarjat));
    }

    public static function sarja_show(){
        View::make('sarja/sarja_show.html');
    }
    
    public static function sarja_edit(){
        View::make('sarja/sarja_edit.html');
    }

    public static function login(){
        View::make('suunnitelmat/login.html');
    }
    
    public static function etusivu(){
        View::make('suunnitelmat/etusivu.html');
    }
  }
