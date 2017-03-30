<?php

class SarjaController extends BaseController{
    public static function index(){
        // kaikki sarjat
        $sarjat = Sarja::all();
        View::make('sarja/etusivu.html', array('sarjat' => $sarjat));
    }
    
    public static function show($id){
        $sarja = Sarja::find($id);
        View::make('sarja/sarja_show.html', array('sarja' => $sarja));
    }
    
    public static function edit($id){
        $sarja = Sarja::find($id);
        View::make('sarja/sarja_edit.html', array('sarja' => $sarja));
    }
    
    public static function create(){
        View::make('sarja/new.html');
    }
    
    public static function store(){
        // POST-pyynnön muuttujat sijaistsevat $_POST -nimisessä assosiaatiolistassa
        $params = $_POST;
        // Alustetaan uusi Sarja-luokan olion käyttäjän syöttämillä arvoilla
        $sarja = new Sarja(array(
            'nimi' => $params['nimi'],
            'network' => $params['network'],
            'julkaistu' => $params['julkaistu'],
            'kausia' => $params['kausia'],
            'jaksoja' => $params['jaksoja'],
            'kuvaus' => $params['kuvaus'],
        ));
        
//         Kint::dump($params);
        
        // Kutsutaan alustamamme olion save-metodia, joka tallentaa olion tietokantaan
        $sarja->save();
        
        // Ohjataan käyttäjä lisäyksen jälkeen sarjan esittelysivulle
        Redirect::to('/sarja/' .$sarja->id, array('message' => 'Sarja on nyt lisätty!'));
    }
    
    
}

