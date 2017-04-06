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
    
    // lomakkeen esittäminen
    public static function edit($id){
        $sarja = Sarja::find($id);
        View::make('sarja/sarja_edit.html', array('attributes' => $sarja));
    }
    
    //lomakkeen käsittely
    public static function update($id){
        $params = $_POST;
        
        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi'],
            'network' => $params['network'],
            'julkaistu' => $params['julkaistu'],
            'kausia' => $params['kausia'],
            'jaksoja' => $params['jaksoja'],
            'kuvaus' => $params['kuvaus']
        );
//        Kint::dump($attributes);
//        die();
        //Sarja-olion alustus käyttäjän syöttämillä tiedoilla
        $sarja = new Sarja($attributes);
        $errors = $sarja->errors();
        
        if(count($errors) > 0){
            View::make('sarja/sarja_edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            // update-metodin kutsuminen
            $sarja->update();
            
            Redirect::to('/sarja/' . $sarja->id, array('message' => 'Sarjan tiedot muokattu onnistuneesti!'));
        }
    }
    
    // Pelin poistaminen
    public static function destroy($id){
        // Sarja-olion alustus annetulla id:llä
        $sarja = new Sarja(array('id'=> $id));
        $sarja->destroy();
        
        // Käyttäjä siirretään listaussivulle ilmoituksen kera
        Redirect::to('/sarja_list', array('message' => 'Sarja poistettu onnistuneesti!'));
    }


    public static function create(){
        View::make('sarja/new.html');
    }
    
    public static function store(){
        // POST-pyynnön muuttujat sijaistsevat $_POST -nimisessä assosiaatiolistassa
        $params = $_POST;
        // Alustetaan uusi Sarja-luokan olion käyttäjän syöttämillä arvoilla
//        $sarja = new Sarja(array(
        $attributes = array(
            'nimi' => $params['nimi'],
            'network' => $params['network'],
            'julkaistu' => $params['julkaistu'],
            'kausia' => $params['kausia'],
            'jaksoja' => $params['jaksoja'],
            'kuvaus' => $params['kuvaus'],
        );
        $sarja = new Sarja($attributes);
        $errors = $sarja->errors();
        
        if(count($errors) == 0) {
            $sarja->save();
            
            Redirect::to('/sarja/' .$sarja->id, array('message' => 'Tiedot tallennettu onnistuneesti!'));
        } else {
            View::make('sarja/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
        
        
        
        
//         Kint::dump($params);
        
        // Kutsutaan alustamamme olion save-metodia, joka tallentaa olion tietokantaan
        
        
        // Ohjataan käyttäjä lisäyksen jälkeen sarjan esittelysivulle
        
    }
    
    
}

