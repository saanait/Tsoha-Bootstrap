<?php

class SarjaController extends BaseController{
    public static function index(){
        
        
        // kaikki sarjat
        $sarjat = Sarja::all();
        View::make('sarja/etusivu.html', array('sarjat' => $sarjat));
    }
    
    public static function show($id){
        self::check_logged_in();
        $sarja = Sarja::find($id);
        $genret = Sarja::genret($id);
//        Kint::dump($genret);
        View::make('sarja/sarja_show.html', array('sarja' => $sarja, 'genret' => $genret));
    }
    

    
    // lomakkeen esittäminen
    public static function edit($id){
        self::check_logged_in();
        $sarja = Sarja::find($id);
        View::make('sarja/sarja_edit.html', array('attributes' => $sarja));
    }
    
    //lomakkeen käsittely
    public static function update($id){
        self::check_logged_in();
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
        self::check_logged_in();
        // Sarja-olion alustus annetulla id:llä
        $sarja = new Sarja(array('id'=> $id));
        $sarja->destroy();
        
        // Käyttäjä siirretään listaussivulle ilmoituksen kera
        Redirect::to('/sarja_list', array('message' => 'Sarja poistettu onnistuneesti!'));
    }


    public static function create(){
        self::check_logged_in();
        $genre = Genre::all();
//        Kint::dump($genre);
        View::make('sarja/new.html', array('genret' => $genre));
    }
    
    public static function store(){
        self::check_logged_in();
        // POST-pyynnön muuttujat sijaistsevat $_POST -nimisessä assosiaatiolistassa
        $params = $_POST;
        // Alustetaan uusi Sarja-luokan olion käyttäjän syöttämillä arvoilla
//        $sarja = new Sarja(array(
        
        // Otetaan talteen valittujen genrejen id:t
        $genret = $params['genret'];
        
        $attributes = array(
            'nimi' => $params['nimi'],
            'network' => $params['network'],
            'julkaistu' => $params['julkaistu'],
            'kausia' => $params['kausia'],
            'jaksoja' => $params['jaksoja'],
            'genret' => array(),
            'kuvaus' => $params['kuvaus']
        );
        
        foreach($genret as $genre){
            $attributes['genret'][] = $genre;
        }
        
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

